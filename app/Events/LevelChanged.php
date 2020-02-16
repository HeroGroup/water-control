<?php

namespace App\Events;

use App\DeviceLog;
use App\Http\Controllers\AlarmController;
use App\Http\Controllers\DeviceController;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class LevelChanged implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $deviceLog;
    public $inputData;
    public $deviceId;
    public $deviceUniqueNumber;
    public $level;
    public $currentStatus;
    public $lastActive;

    public function __construct(DeviceLog $deviceLog)
    {
        // $this->deviceLog = $deviceLog;
        $deviceController = new DeviceController();
        $deviceData = $deviceController->getDeviceStatus($deviceLog->device_id)->original['data'];
        $this->inputData = $deviceLog->input_data;
        $this->deviceId = $deviceLog->device_id;
        $this->deviceUniqueNumber = $deviceLog->device->unique_number;
        $this->level = $deviceData['level'];
        $this->currentStatus = $deviceData['status'];
        $this->lastActive = $deviceData['lastActive'];
    }

    public function broadcastOn()
    {
        // return new PrivateChannel('deviceLog.'.$this->deviceLog->device_id);
        return ['level-changed'];
    }
/*
    public function broadcastAs()
    {
        return 'level-changed';
    }
*/
}
