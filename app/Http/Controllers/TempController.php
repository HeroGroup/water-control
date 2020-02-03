<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TempController extends Controller
{
    public function postBatteryAlarmData(Request $request)
    {
        if ($request->device_id && $request->data)
            return $this->success('success');
        else
            return $this->fail('insufficient parameters');
    }

    public function getBatteryAlarmConfig($device)
    {
        return $this->success('success', ['send_data_duration' => 30]);
    }

    public function getBatteryAlarmData($device)
    {
        return $this->success('success', ['config' => "2941.741800,5227.992900,1689.800000,20200124143618"]);
    }
}
