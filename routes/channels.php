<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('deviceLog.{deviceId}', function ($user, $deviceId) {
    $check = \App\DeviceUser::where('device_id', $deviceId)->where('user_id', $user->id)->where('is_active', 1)->count;
    return $check > 0 ? true : false;
});
