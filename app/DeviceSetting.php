<?php

namespace App;

use App\Events\DeviceSettingCreatedOrUpdated;
use Illuminate\Database\Eloquent\Model;

class DeviceSetting extends Model
{
    protected $fillable = ['device_id', 'alarm_level', 'alarm_type'];

    protected $dispatchesEvents = [
        'saved' => DeviceSettingCreatedOrUpdated::class,
    ];
}
