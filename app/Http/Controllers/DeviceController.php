<?php

namespace App\Http\Controllers;

use App\Device;
use App\DeviceAlarm;
use App\DeviceChangelog;
use App\DeviceLog;
use App\DeviceSetting;
use App\DeviceUser;
use App\Events\LevelChanged;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
// require_once app_path('Helpers/utils.php');

class DeviceController extends Controller
{
    public function index()
    {
        $devices = Device::all();
        return view('devices.index', compact('devices'));
    }

    public function create()
    {
        $users = User::where('user_type' ,'LIKE', 'client')->selectRaw('id, CONCAT(mobile,\' - \',name) as info')->pluck('info', 'id')->toArray();
        return view('devices.create', compact('users'));
    }

    public function store(Request $request)
    {
        $device = new Device([
            'unique_number' => $request->unique_number,
            'owner' => $request->owner,
            'level_meter_send_data_duration' => $request->level_meter_send_data_duration,
            'level_meter_gather_data_duration' => $request->level_meter_gather_data_duration,
            // 'level_meter_micro_switch_position' => $request->part_1.'_'.$request->level_1.'&'.$request->part_2.'_'.$request->level_2,
            'level_meter_micro_switch_position' => $request->level_meter_micro_switch_position,
            'alarm_panel_receive_data_duration' => $request->alarm_panel_receive_data_duration,
        ]);

        $device->save();

        if ($request->has('user_id') && count($request->user_id) > 0) {
            foreach ($request->user_id as $item) {
                if ($item != null) {
                    $deviceUser = new DeviceUser([
                        'device_id' => $device->id,
                        'user_id' => $item,
                        'is_active' => true,
                        'activation_date' => Date::now("+3:30"),
                    ]);

                    $deviceUser->save();
                }
            }
        }

        return redirect('admin/devices');
    }

    public function assignUser(Request $request)
    {
        $deviceUser = DeviceUser::where([['device_id', $request->device_id],['user_id', $request->user_id], ['is_active', true]])->get();
        if ($deviceUser->count() == 0) {
            $deviceUser = new DeviceUser([
                'device_id' => $request->device_id,
                'user_id' => $request->user_id,
                'is_active' => true,
                'activation_date' => Date::now("+3:30"),
            ]);

            $deviceUser->save();

            return ['status' => 1, 'message' => 'کاربر با موفقیت انتساب داده شد'];
        } else {
            return ['status' => -1, 'message' => 'این کاربر قبلا به این دستگاه انتساب داده شده است.'];
        }
    }

    public function revokeUser(Request $request)
    {
        $deviceUser = DeviceUser::where('device_id', $request->device_id)->where('user_id', $request->user_id)->where('is_active', true);
        if ($deviceUser->count() > 0) {
            $deviceUser->update(['is_active' => false, 'deactivation_date' => Date::now("+3:30")]);

            return ['status' => 1, 'message' => 'کاربر لغو انتساب شد'];
        } else {
            return ['status' => -1, 'message' => 'خطایی رخ داده است'];
        }
    }

    public function edit(Device $device)
    {
        $users = User::where('user_type' ,'LIKE', 'client')->get(['id','mobile','name']);
        $selectedUsers = DeviceUser::where('device_id', '=', $device->id)->pluck('user_id', 'id')->toArray();
        /*
        $part1 = 0; $level1 = 0; $part2 = 0; $level2 = 0;
        if ($device->level_meter_micro_switch_position) {
            $x = explode('&', $device->level_meter_micro_switch_position);
            $y1 = explode('_', $x[0]);
            $y2 = explode('_', $x[1]);
            $part1 = $y1[0];
            $level1 = $y1[1];
            $part2 = $y2[0];
            $level2 = $y2[1];
        }
        */
        return view('devices.edit', compact('device', 'users', 'selectedUsers'));
    }

    public function update(Request $request, Device $device)
    {
        $device->update([
            'unique_number' => $request->unique_number,
            'owner' => $request->owner,
            'level_meter_send_data_duration' => $request->level_meter_send_data_duration,
            'level_meter_gather_data_duration' => $request->level_meter_gather_data_duration,
            // 'level_meter_micro_switch_position' => $request->part_1.'_'.$request->level_1.'&'.$request->part_2.'_'.$request->level_2,
            'level_meter_micro_switch_position' => $request->level_meter_micro_switch_position,
            'alarm_panel_receive_data_duration' => $request->alarm_panel_receive_data_duration,
        ]);

        return redirect('admin/devices');
    }

    public function destroy(Device $device)
    {
        return redirect('admin/devices');
    }

    public function getDeviceStatus($deviceId)
    {
        $device = Device::find($deviceId);
        if ($device) {
            $ac = new AlarmController();
            $alarms = $ac->getAlarms($deviceId);
            $level = $ac->getLevel($deviceId);
            $maxCreated = DeviceLog::where('device_id', $deviceId)->max('created_at');
            $sendDataDuration = Device::find($deviceId)->level_meter_send_data_duration;
            $deviceStatus = strtotime($maxCreated) + ($sendDataDuration*3) > time() ? 'روشن' : 'خاموش';
            $lastActive = $maxCreated ? jdate('H:i - Y/m/j', strtotime($maxCreated)) : "";

            return $this->success('success', ['alarms' => $alarms, 'level' => $level, 'status' => $deviceStatus, 'lastActive' => $lastActive]);
        } else {
            return $this->fail('invalid device');
        }
    }

    public function currentStatus($deviceId)
    {
        $result = $this->getDeviceStatus($deviceId);
        $result = $result->original;

        if ($result['status'] == 1) {
            $device = Device::find($deviceId);
            $alarms = $result['data']['alarms'];
            $level = $result['data']['level'];

            return view('devices.status', compact('device', 'alarms', 'level'));
        } else {
            return abort(404);
        }
    }

    public function getRawData($deviceId)
    {
        $device = Device::find($deviceId);
        $logs = DeviceLog::where('device_id', $deviceId)->orderBy('id', 'desc')->take(100)->paginate(20);

        return view('devices.showRawData', compact('device', 'logs'));
    }

    public function changelog($deviceId)
    {
        $device = Device::find($deviceId);
        if ($device) {
            $changelog = DeviceChangelog::where('device_id', $deviceId)->orderBy('id', 'desc')->get();
            $deviceUsers = DeviceUser::where('device_id', $deviceId)->get();

            return view('devices.changelog', compact('device', 'changelog', 'deviceUsers'));
        } else {
            return abort(404);
        }
    }

    public function getDeviceSettings($deviceId)
    {
        $setting = DeviceSetting::where('device_id', $deviceId)->first();
        $updated_at = $setting ? jdate('H:i - Y/m/j', strtotime($setting->updated_at)) : "";
        $level = $setting ? $setting->alarm_level : null;
        $alarmType = $setting ? explode(",", $setting->alarm_type) : [];

        return ['updated_at' => $updated_at, 'level' => $level, 'alarmType' => $alarmType];
    }

    public function postDeviceSettings($deviceId, $alarmLevel, $alarmType)
    {
        if ($deviceId > 0) {
            $deviceSetting = DeviceSetting::where('device_id', $deviceId)->first();
            if ($deviceSetting)
                $deviceSetting->update([
                    'alarm_level' => $alarmLevel,
                    'alarm_type' => $alarmType
                ]);
            else
                $deviceSetting = new DeviceSetting([
                    'device_id' => $deviceId,
                    'alarm_level' => $alarmLevel,
                    'alarm_type' => $alarmType
                ]);

            $deviceSetting->save();

            logAction('update_device_settings', $deviceId);
        }
    }

    // ===========      START API     ===========  //
    public function postDeviceData(Request $request)
    {
        try {
            $content = $request->getContent();
            logPostData($content);
            $body = json_decode($content);

            if ($body && isset($body->device_id) && isset($body->data)) {
                $device = Device::where('unique_number', 'LIKE', $body->device_id)->first();
                if ($device) {
                    $log = new DeviceLog([
                        'device_id' => $device->id,
                        'input_data' => $body->data
                    ]);

                    $log->save();

                    /*=============================*/
                    $chat = new ChatController();
                    $chat->broadcast(json_encode($log->toArray()), $chat->getClients());
                    /*=============================*/

                    $ac = new AlarmController();
                    $sendNotificationResult = "";
                    $currentLevel = $ac->getLevel($device->id);
                    $deviceSetting = DeviceSetting::where('device_id', $device->id);
                    if ($deviceSetting && $currentLevel >= $deviceSetting->first()->alarm_level) {
                        if (strpos($deviceSetting->first()->alarm_type, 'notification') >= 0) {
                            foreach ($device->activeUsers as $deviceUser)
                                if ($deviceUser->user && $deviceUser->user->fcm_token != null && strlen($deviceUser->user->fcm_token) > 0)
                                    $sendNotificationResult .= NotificationController::send('اخطار', 'آب بالاتر از سطح اخطار آمده است.', null, $deviceUser->user->fcm_token);
                        }
                        if (strpos($deviceSetting->first()->alarm_type, 'sms') >= 0) {
                            // send sms
                        }
                    }
                    return $this->success('data stored successfully. '.$sendNotificationResult);
                } else {
                    return $this->fail('invalid device');
                }
            } else {
                return $this->fail('invalid parameters');
            }
        } catch (\Exception $exception) {
            logException($exception);
            return $this->fail($exception->getMessage());
        }
    }

    public function getDeviceData($deviceNum)
    {
        try {
            $device = Device::where('unique_number', 'LIKE', $deviceNum)->first();
            $maxId = DeviceLog::where('device_id', '=', $device->id)->max('id');
            $latestLog = DeviceLog::find($maxId);

            logGetDeviceData($latestLog);
            return $this->success('data retrieved successfully', $latestLog->input_data);
        } catch (\Exception $exception) {
            return $this->fail($exception->getMessage());
        }
    }

    public function getLevelAlarmConfig($deviceNum)
    {
        try {
            $device = Device::where('unique_number', 'LIKE', $deviceNum)->first();
            $data = [
                'receive_data_duration' => $device->alarm_panel_receive_data_duration,
                'micro_switch_position' => (int)$device->level_meter_micro_switch_position
            ];

            return $this->success('data retrieved successfully', $data);
        } catch (\Exception $exception) {
            return $this->fail($exception->getMessage());
        }
    }

    public function getLevelMeterConfig($deviceNum)
    {
        try {
            $device = Device::where('unique_number', 'LIKE', $deviceNum)->first();
            $data = [
                'send_data_duration' => $device->level_meter_send_data_duration,
                'level_query_duration' => $device->level_meter_gather_data_duration
            ];

            return $this->success('data retrieved successfully', $data);
        } catch (\Exception $exception) {
            return $this->fail($exception->getMessage());
        }
    }
    // ===========      END   API     ===========  //

    // ===========      START CLIENT     ===========  //
    public function deviceSettings()
    {
        $result = $this->getDeviceSettings(session('deviceId'));
        $updated_at = $result['updated_at'];
        $level = $result['level'];
        $alarmType = $result['alarmType'];

        return view('client.setting', compact('level', 'updated_at', 'alarmType'));
    }

    public function updateDeviceSettings(Request $request)
    {
        if (session('deviceId') > 0) {
            $alarmType = "";
            if (count($request->alarmType) > 0) {
                foreach ($request->alarmType as $key => $item) {
                    $alarmType .= $key . ",";
                }
            }

            $deviceSetting = DeviceSetting::where('device_id', session('deviceId'))->first();
            if ($deviceSetting)
                $deviceSetting->update([
                    'alarm_level' => $request->level,
                    'alarm_type' => $alarmType
                ]);
            else
                $deviceSetting = new DeviceSetting([
                    'device_id' => session('deviceId'),
                    'alarm_level' => $request->level,
                    'alarm_type' => $alarmType
                ]);

            $deviceSetting->save();

            logAction('update_device_settings', session('deviceId'));
        }

        return redirect('client/setting');
    }
    // ===========      END   CLIENT     ===========  //
}
