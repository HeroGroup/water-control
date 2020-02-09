<?php

namespace App;

use App\Events\DeviceCreatedOrUpdated;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $fillable = [
        'unique_number',
        'owner',
        'level_meter_send_data_duration',
        'level_meter_gather_data_duration',
        'level_meter_micro_switch_position',
        'alarm_panel_receive_data_duration'
    ];

    protected $dispatchesEvents = [
        'saved' => DeviceCreatedOrUpdated::class,
    ];

    public function users()
    {
        return $this->hasMany(DeviceUser::class);
    }

    public function activeUsers()
    {
        return $this->hasMany(DeviceUser::class)->where('is_active', 1);
    }

    public function userNames()
    {
        $users = $this->users()->where('is_active', 1)->get();
        $result = "";
        for($i=0; $i<$users->count(); $i++) {
            $result .= " ".$users[$i]->user->name;
            if ($i < $users->count()-1)
                $result .= " - ";
        }

        return $result;
    }
}
