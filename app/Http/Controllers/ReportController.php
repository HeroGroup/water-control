<?php

namespace App\Http\Controllers;

use App\DeviceAlarm;
use App\DeviceLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function getReport(Request $request)
    {
        $fromYear = substr($request->date_input_1, 0, 4);
        $fromMonth = substr($request->date_input_1, 5, 2);
        $fromDay = substr($request->date_input_1, 8, 2);
        $toYear = substr($request->date_input_2, 0, 4);
        $toMonth = substr($request->date_input_2, 5, 2);
        $toDay = substr($request->date_input_2, 8, 2);
        $from = jalali_to_gregorian($fromYear,$fromMonth,$fromDay);
        $from[1] = strlen($from[1])<2 ? '0'.$from[1] : $from[1];
        $from = implode('-', $from);
        $to = jalali_to_gregorian($toYear,$toMonth,$toDay);
        $to[1] = strlen($to[1])<2 ? '0'.$to[1] : $to[1];
        $to = implode('-', $to);

        switch ($request->reportType) {
            case 0: // گزارش هشدار ها
                $alarms = DeviceAlarm::where('device_id', $request->device)
                    ->whereBetween('created_at', [$from, $to])->get();
                return $this->success('success', $alarms);
                break;
            case 1: // گزارش از سطح آب از تاریخ تا تاریخ
                $data = DB::table('device_logs')
                    ->select(DB::raw('SUBSTRING(created_at, 1, 10) created, MIN(level) min_level, MAX(level) max_level'))
                    ->where('device_id', $request->device)
                    ->whereBetween('created_at', [$from, $to])
                    ->groupBy('created')
                    ->get();

                return $this->success('success', $data);
                break;
            case 2: // گزارش از سطح آب در ساعات یک روز
                $data = DB::table('device_logs')
                    ->select(DB::raw('SUBSTRING(created_at, 12, 2) created, AVG(level) avg_level'))
                    ->where('device_id', $request->device)
                    ->where('created_at', 'LIKE', '%'.$from.'%')
                    ->groupBy('created')
                    ->get();

                return $this->success('success', $data);
                break;
            default:
                break;
        }
    }
}
