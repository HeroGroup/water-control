<?php

namespace App\Listeners;

use App\DeviceChangelog;
use App\Events\DeviceCreatedOrUpdated;

class CreateDeviceChangeLog
{
    public function __construct()
    {
        //
    }

    public function handle(DeviceCreatedOrUpdated $event)
    {
        $deviceChangelog = new DeviceChangelog([
            'device_id' => $event->device->id,
            'level_meter_send_data_duration' => $event->device->level_meter_send_data_duration,
            'level_meter_gather_data_duration' => $event->device->level_meter_gather_data_duration,
            'level_meter_micro_switch_position' => $event->device->level_meter_micro_switch_position,
            'alarm_panel_receive_data_duration' => $event->device->alarm_panel_receive_data_duration,
            'user_id' => auth()->user()->id
        ]);
        $deviceChangelog->save();
    }
}
