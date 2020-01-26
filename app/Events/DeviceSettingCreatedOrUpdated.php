<?php

namespace App\Events;

use App\DeviceSetting;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class DeviceSettingCreatedOrUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $deviceSetting;

    public function __construct(DeviceSetting $deviceSetting)
    {
        $this->deviceSetting = $deviceSetting;
    }
}
