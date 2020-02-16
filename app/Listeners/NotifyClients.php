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

        $alarmController->clearAlarms($event->deviceId, $event->inputData);

        $alarmController->generateAlarms($event->deviceId, $event->inputData);

        // logPostDeviceData($event->deviceLog);
    }
}
