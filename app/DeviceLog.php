<?php

namespace App;

use App\Events\LevelChanged;
use Illuminate\Database\Eloquent\Model;

class DeviceLog extends Model
{
    protected $dispatchesEvents = [
        'saved' => LevelChanged::class,
    ];

    protected $fillable = ['device_id', 'input_data', 'level'];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}
