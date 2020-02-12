<?php

namespace App\Http\Controllers;

use App\Device;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
// require_once app_path('Helpers/utils.php');

class MobileController extends Controller
{
    protected $SERVER_ERROR = 'خطای سرور، لطفا مجددا تلاش کنید';

    public function login(Request $request)
    {
        try {
            if (strlen($request->mobile) < 11 || substr($request->mobile, 0, 2) != '09')
                return $this->fail('شماره موبایل نامعتبر است.');

            if (Auth::attempt(['mobile' => $request->mobile, 'password' => $request->password])) {
                $user = User::where('mobile', $request->mobile)->first();
                Auth::loginUsingId($user->id);
                $api_token = setUserApiToken($user->id, $request->fcmToken);

                logAction('login');

                $userData = [
                    'username' => $user->name,
                    'mobile' => $user->mobile,
                    'api_token' => $api_token,
                    'profile_completed' => $user->profile_completed,
                ];

                $device = $user->devices->first() ? $user->devices->first()->device->unique_number : 0;
                return $this->success('data retrieved successfully.', ['user' => $userData, 'deviceId' => $device]);
            } else {
                return $this->fail('کاربر با این مشخصات وجود ندارد.');
            }
        } catch (\Exception $exception) {
            // $message = $exception->getFile() . ' line: ' . $exception->getLine() . '. '. $exception->getMessage();
            $message = $this->SERVER_ERROR;
            return $this->fail($message);
        }
    }

    public function updatePassword(Request $request)
    {
        try {
            $user = User::find($request->userId);
            if ($request->has('current_password'))
                if (Hash::check($request->current_password, $user->password))
                    return $this->fail('رمز عبور فعلی نادرست است.');

            if ($request->has('password') && $request->has('password_confirmation')) {
                if ($request->password == $request->password_confirmation) {
                    $user->password = Hash::make($request->password);
                    $user->profile_completed = true;
                    $api_token = setUserApiToken($user->id);
                    $user->save();

                    $data = ['api_token' => $api_token];
                    return $this->success('رمز عبور با موفقیت بروزرسانی شد.', $data);
                } else {
                    return $this->fail('رمز عبور و تکرار آن همخوانی ندارند.');
                }
            } else {
                return $this->fail('خطا در پارامتر های ارسالی.');
            }
        } catch (\Exception $exception) {
            return $this->fail($exception->getMessage());
        }
    }

    public function getCurrentStatus($device)
    {
        try {
            $device = Device::where('unique_number', 'LIKE', $device)->first();
            $deviceId = 0;
            if ($device)
                $deviceId = $device->id;

            if ($deviceId) {
                $deviceController = new DeviceController();
                $result = $deviceController->getDeviceStatus($deviceId);
                $result = $result->original;

                if ($result['status'] == 1) {
                    return $this->success('data retrieved successfully', [
                        'alarms' => $result['data']['alarms'],
                        'level' => $result['data']['level'],
                        'status' => $result['data']['status'],
                        'lastActive' => $result['data']['lastActive']
                    ]);
                } else {
                    return $this->fail('خطایی رخ داده است.');
                }
            } else {
                return $this->fail('دستگاه نامعتبر');
            }
        } catch (\Exception $exception) {
            // $message = $exception->getFile() . ' line: ' . $exception->getLine() . '. '. $exception->getMessage();
            $message = $this->SERVER_ERROR;
            return $this->fail($message);
        }
    }

    public function getDeviceSettings($device)
    {
        try {
            $device = Device::where('unique_number', 'LIKE', $device)->first();
            $deviceId = 0;
            if ($device)
                $deviceId = $device->id;

            if ($deviceId && Device::find($deviceId)) {
                $deviceController = new DeviceController();
                $result = $deviceController->getDeviceSettings($deviceId);
                $updated_at = $result['updated_at'];
                $level = $result['level'];
                $alarmType = $result['alarmType'];

                return $this->success('settings retrieved successfully', [
                    'level' => $level,
                    'updated_at' => $updated_at,
                    'alarmType' => json_encode($alarmType)
                ]);
            } else {
                return $this->fail('دستگاه نامعتبر');
            }
        } catch (\Exception $exception) {
            // $message = $exception->getFile() . ' line: ' . $exception->getLine() . '. '. $exception->getMessage();
            $message = $this->SERVER_ERROR;
            return $this->fail($message);
        }
    }

    public function updateDeviceSettings(Request $request)
    {
        try {
            $device = Device::where('unique_number', 'LIKE', $request->deviceId)->first();
            $deviceId = 0;
            if ($device)
                $deviceId = $device->id;

            $deviceController = new DeviceController();
            $deviceController->postDeviceSettings($deviceId, $request->alarmLevel, $request->alarmType);

            return $this->success('تغییرات با موفقیت ذخیره شد.');
        } catch (\Exception $exception) {
            // $message = $exception->getFile() . ' line: ' . $exception->getLine() . '. '. $exception->getMessage();
            $message = $this->SERVER_ERROR;
            return $this->fail($message);
        }
    }

    public function getDeviceAlarms($device)
    {
        try {
            $device = Device::where('unique_number', 'LIKE', $device)->first();
            $deviceId = 0;
            if ($device)
                $deviceId = $device->id;

            $ac = new AlarmController();
            $alarms = $ac->getAlarms($deviceId);

            return $this->success('alarms retrieved successfully', $alarms);
        } catch (\Exception $exception) {
            // $message = $exception->getFile() . ' line: ' . $exception->getLine() . '. '. $exception->getMessage();
            $message = $this->SERVER_ERROR;
            return $this->fail($message);
        }
    }
}
