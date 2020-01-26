<?php

namespace App\Http\Controllers;

use App\Device;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MobileController extends Controller
{
    // login
    // get device on/off status, latest update, level and alarms
    // get device settings
    // update device settings

    public function login(Request $request)
    {
        if (strlen($request->mobile) < 11 || substr($request->mobile, 0, 2) != '09')
            return $this->fail('شماره موبایل نامعتبر است.');

        if (Auth::attempt(['mobile' => $request->mobile, 'password' => $request->password])) {
            $user = User::where('mobile', $request->mobile)->first();
            $api_token = Str::random(60);
            $user->api_token = $api_token;
            $user->save();

            return $this->success('data retrieved successfully.', ['username' => '', 'deviceId' => 0, 'api_token' => $api_token]);
        } else {
            return $this->fail('کاربر با این مشخصات وجود ندارد.');
        }
    }

    public function getCurrentStatus(Request $request)
    {
        $deviceId = $request->deviceId;
        if ($deviceId && Device::find($deviceId)) {
            $deviceController = new DeviceController();
            $result = json_decode($deviceController->getDeviceStatus($deviceId));

            return $this->success('data retrieved successfully', [
                'alarms' => $result->data->alarms,
                'level' => $result->data->level,
                'status' => $result->data->deviceStatus,
                'lastActive' => $result->data->lastActive
            ]);
        } else {
            return $this->fail('');
        }
    }

    public function getDeviceSettings(Request $request)
    {
        // $request->deviceId
    }

    public function updateDeviceSettings(Request $request)
    {
        // $request->deviceId
    }
}
