<?php

namespace App\Events;

use App\DeviceLog;
use App\Http\Controllers\AlarmController;
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
    public $level;

    public function __construct(DeviceLog $deviceLog)
    {
        $this->deviceLog = $deviceLog;
        $ac = new AlarmController();
        $this->level = $ac->getLevel($deviceLog->device_id);
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
