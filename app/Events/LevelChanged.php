<?php

namespace App\Events;

use App\DeviceLog;
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

    public function __construct(DeviceLog $deviceLog)
    {
        $this->deviceLog = $deviceLog;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('deviceLog.'.$this->deviceLog->device_id);
    }

    public function broadcastAs()
    {
        return 'level.changed';
    }

}
