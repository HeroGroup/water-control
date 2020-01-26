<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alarm extends Model
{
    protected $fillable = [
        'alarm_message',
        'alarm_type',
        'alarm_icon'
    ];
}
