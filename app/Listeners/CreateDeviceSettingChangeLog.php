<?php

namespace App\Listeners;

use App\DeviceChangelog;
use App\Events\DeviceSettingCreatedOrUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateDeviceSettingChangeLog
{
    public function __construct()
    {
        //
    }

    public function handle(DeviceSettingCreatedOrUpdated $event)
    {
        $deviceChangelog = new DeviceChangelog([
            'device_id' => $event->deviceSetting->device_id,
            'alarm_level' => $event->deviceSetting->alarm_level,
            'alarm_type' => $event->deviceSetting->alarm_type,
            'user_id' => auth()->user()->id
        ]);
        $deviceChangelog->save();
    }
}
