<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeviceAlarm extends Model
{
    protected $fillable = [
        'device_id',
        'part_index',
        'sensor_index',
        'alarm_id',
        'is_cleared'
    ];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    public function alarm()
    {
        return $this->belongsTo(Alarm::class);
    }
}
