<?php

namespace App\Http\Controllers;

use App\Alarm;
use App\DeviceAlarm;
use App\DeviceLog;
use BeyondCode\DumpServer\DumpServerServiceProvider;
use Illuminate\Http\Request;
// require_once app_path('Helpers/utils.php');

class AlarmController extends Controller
{
    public function index()
    {
        $alarms = Alarm::all();
        return view('alarms.index', compact('alarms'));
    }

    public function create()
    {
        return view('alarms.create');
    }

    public function store(Request $request)
    {
//        $icon = null;
//        if ($request->hasFile('alarm_icon'))
//            $icon = saveFile($request->alarm_icon, 'images');

        $imageUrl = null;
        if($request->hasFile('alarm_icon')){
            $image = $request->alarm_icon;
            $fileName = time().'.'.$image->getClientOriginalName();
            $image->move('resources/assets/images/alarm_icons/', $fileName);
            $imageUrl = '/resources/assets/images/alarm_icons/'.$fileName;
        }

        $alarm = new Alarm([
            'alarm_message' => $request->alarm_message,
            'alarm_type' => $request->alarm_type,
            'alarm_icon' => $imageUrl
        ]);

        $alarm->save();

        return redirect(route('alarms.index'));
    }

    public function show(Alarm $alarm)
    {
        //
    }

    public function edit(Alarm $alarm)
    {
        return view('alarms.edit', compact('alarm'));
    }

    public function update(Request $request, Alarm $alarm)
    {
        if ($request->hasFile('alarm_icon'))
            $icon = saveFile($request->alarm_icon, 'images');

        $alarm->update([
            'alarm_message' => $request->alarm_message,
            'alarm_type' => $request->alarm_type,
            'alarm_icon' => isset($icon) ? $icon : $alarm->alarm_icon
        ]);

        return redirect(route('alarms.index'));
    }

    public function destroy(Alarm $alarm)
    {
        $deviceAlarms = DeviceAlarm::where('alarm_id', $alarm->id)->count();
        if ($deviceAlarms > 0) {
            return redirect(route('alarms.index'))->with('message', 'امکان حذف هشدار به دلیل وابستگی وجود ندارد.')->with('type', 'danger');
        } else {
            $alarm->delete();
            return redirect(route('alarms.index'))->with('message', 'هشدار با موفقیت حذف شد.')->with('type', 'success');
        }
    }

    public function getLevel($deviceId)
    {
        $maxId = DeviceLog::where('device_id', '=', $deviceId)->max('id');
        $level = 0;
        if ($maxId) {
            $latestLog = DeviceLog::find($maxId);
            $data = explode('&', $latestLog->input_data);

            $part1 = array_slice($data,0,20);
            $part2 = array_slice($data,21,20);
            $part1IsCorrupted = false;
            $part2IsCorrupted = false;

            if (current($part1) == -1 && end($part1) == -1 && count(array_unique($part1)) == 1) { // all values are -1 // device is not sending any data
                $part1IsCorrupted = true;
            }

            if (current($part2) == -1 && end($part2) == -1 && count(array_unique($part2)) == 1) { // all values are -1 // device is not sending any data
                $part2IsCorrupted = true;
            }

            if (!$part1IsCorrupted)
                for ($i = 0; $i < count($part1); $i+=2)
                    if ($part1[$i] == "1" || $part1[$i + 1] == "1")
                        $level = $i/2 + 1;

            if (!$part2IsCorrupted)
                for ($i = 0; $i < count($part2); $i += 2)
                    if ($part2[$i] == 1 || $part2[$i + 1] == 1)
                        $level = intdiv($i, 2) + 11;
/*
            $compactData = [];
            for ($i = 0; $i < count($data); $i += 2) {
                // $index = intdiv($i, 2);
                // $compactData[$index] = ($data[$i] == "1" || $data[$i + 1] == "1") ? "1" : "0";
                $compactData[$i] = ($data[$i] == "1" || $data[$i + 1] == "1") ? "1" : "0";
            }

            for ($i = 0; $i < count($compactData); $i++) {
                if ($compactData[$i] == "1") {
                    $level = $i + 1;
                    for ($j = $i; $j < count($compactData) - $i + 1; $j++) {
                        if ($compactData[$j] == "1")
                            break;
                    }
                }
            }
*/
        }

        return $level;
    }

    public function getAlarms($deviceId)
    {
        $devicePartsAlarms = DeviceAlarm::where([['device_id', $deviceId],['alarm_id', 4],['is_cleared', false]])->orderBy('id', 'desc')->with('alarm')->get();
        $deviceAlarms = DeviceAlarm::where([['device_id', $deviceId],['alarm_id', 2],['is_cleared', false]])->orderBy('id', 'desc')->with('alarm')->get();
        $alarms = [];
        foreach ($devicePartsAlarms as $deviceAlarm) {
            $item = [
                'alarm_icon' => $deviceAlarm->alarm->alarm_icon,
                'alarm_message' => str_replace('index', $deviceAlarm->part_index, $deviceAlarm->alarm->alarm_message),
                'created_at' => jdate('H:i - Y/m/j', strtotime($deviceAlarm->updated_at))
            ];
            array_push($alarms, $item);
        }

        foreach ($deviceAlarms as $deviceAlarm) {
            $item = [
                'alarm_icon' => $deviceAlarm->alarm->alarm_icon,
                'alarm_message' => str_replace('index', $deviceAlarm->sensor_index, $deviceAlarm->alarm->alarm_message),
                'created_at' => jdate('H:i - Y/m/j', strtotime($deviceAlarm->updated_at))
            ];
            array_push($alarms, $item);
        }

        return $alarms;
    }

    public function generateAlarms($deviceId, $inputData)
    {
        $data = explode('&', $inputData);

        $part1 = array_slice($data,0,20);
        $part2 = array_slice($data,21,20);

        if (current($part1) == -1 && end($part1) == -1 && count(array_unique($part1)) == 1) { // all values are -1
            if (DeviceAlarm::where([['device_id', $deviceId],['part_index', 0],['is_cleared', 0]])->count() == 0) {
                DeviceAlarm::create([
                    'device_id' => $deviceId,
                    'part_index' => 0,
                    'alarm_id' => 4,
                    'is_cleared' => false
                ]);
            }
        }

        if (current($part2) == -1 && end($part2) == -1 && count(array_unique($part2)) == 1) { // all values are -1
            if (DeviceAlarm::where([['device_id', $deviceId],['part_index', 1],['is_cleared', 0]])->count() == 0) {
                DeviceAlarm::create([
                    'device_id' => $deviceId,
                    'part_index' => 1,
                    'alarm_id' => 4,
                    'is_cleared' => false
                ]);
            }
        }

        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i] == "0") {
                for ($j = 0; $j < count($data); $j++) {
                    if ($j > $i && $data[$j] == "1") { // $i is broken sensor
                        if (DeviceAlarm::where([['device_id', $deviceId],['sensor_index', $i],['is_cleared', 0]])->count() == 0) {
                            DeviceAlarm::create([
                                'device_id' => $deviceId,
                                'sensor_index' => $i,
                                'alarm_id' => 2,
                                'is_cleared' => false
                            ]);
                        }
                        break;
                    }
                }
            }
        }
    }

    public function clearAlarms($deviceId, $inputData)
    {
        $dataArray = explode('&', $inputData);
        $activeAlarms = DeviceAlarm::where('device_id', $deviceId)->where('alarm_id', 2)->where('is_cleared', 0)->get();

        foreach ($activeAlarms as $activeAlarm) {
            if (isset($dataArray[$activeAlarm->sensor_index]) && $dataArray[$activeAlarm->sensor_index] == '1') {
                $activeAlarm->is_cleared = 1;
                $activeAlarm->save();
            }
        }

        $part1 = array_slice($dataArray,0,20);
        $part2 = array_slice($dataArray,21,20);
        $part1Corrupted = false;
        $part2Corrupted = false;

        if (current($part1) == -1 && end($part1) == -1 && count(array_unique($part1)) == 1)
            $part1Corrupted = true;
        $part1Error = DeviceAlarm::where('device_id', $deviceId)->where('part_index', 0)->where('alarm_id', 4)->where('is_cleared', 0);
        if (!$part1Corrupted && $part1Error->count() > 0)
            $part1Error->update(['is_cleared' => 1]);

        if (current($part2) == -1 && end($part2) == -1 && count(array_unique($part2)) == 1)
            $part2Corrupted = true;
        $part2Error = DeviceAlarm::where('device_id', $deviceId)->where('part_index', 1)->where('alarm_id', 4)->where('is_cleared', 0);
        if (!$part2Corrupted && $part2Error->count() > 0)
            $part2Error->update(['is_cleared' => 1]);
    }
}
