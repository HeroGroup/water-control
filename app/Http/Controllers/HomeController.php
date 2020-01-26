<?php

namespace App\Http\Controllers;

use App\Device;
use App\DeviceLog;
use App\DeviceUser;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.home');
    }

    public function clientIndex()
    {
        if (auth()->user()->user_type == 'client') {
            $userId = auth()->user()->id;
            if ($userId) {
                $deviceController = new DeviceController();
                $result = $deviceController->getDeviceStatus(session('deviceId'));
                $result = $result->original;

                if ($result['status'] == 1) {
                    $deviceStatus = $result['data']['status'];
                    $lastActive = $result['data']['lastActive'];
                    $level = $result['data']['level'];
                    $alarms = $result['data']['alarms'];

                    return view('client.home', compact('deviceStatus', 'lastActive', 'level', 'alarms'));
                } else {
                    return abort(503);
                }
            } else {
                return abort(404);
            }
        } else {
            return abort(401);
        }
    }

    public function report()
    {
        return view('client.reports');
    }

    public function generateReport(Request $request)
    {
        //
    }
}

