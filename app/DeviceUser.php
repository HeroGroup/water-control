<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeviceUser extends Model
{
    protected $fillable = [
        'device_id',
        'user_id',
        'is_active',
        'activation_date',
        'deactivation_date',
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
