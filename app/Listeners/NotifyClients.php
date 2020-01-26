<?php

namespace App\Listeners;

use App\Events\LevelChanged;
use App\Http\Controllers\AlarmController;

class NotifyClients
{
    public function __construct()
    {
        //
    }

    public function handle(LevelChanged $event)
    {
        $alarmController = new AlarmController();

        $alarmController->clearAlarms($event->deviceLog->device_id, $event->deviceLog->input_data);

        $alarmController->generateAlarms($event->deviceLog->device_id, $event->deviceLog->input_data);

        // logPostDeviceData($event->deviceLog);
    }
}
