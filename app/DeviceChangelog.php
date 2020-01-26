<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeviceChangelog extends Model
{
    protected $fillable = [
        'device_id',
        'level_meter_send_data_duration',
        'level_meter_gather_data_duration',
        'level_meter_micro_switch_position',
        'alarm_panel_receive_data_duration',
        'alarm_level',
        'alarm_type',
        'user_id'
    ];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
