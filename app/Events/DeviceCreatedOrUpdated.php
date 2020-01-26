<?php

namespace App\Events;

use App\Device;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class DeviceCreatedOrUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $device;

    public function __construct(Device $device)
    {
        $this->device = $device;
    }
}
