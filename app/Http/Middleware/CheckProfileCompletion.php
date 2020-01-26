<?php

namespace App\Http\Middleware;

use App\DeviceUser;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckProfileCompletion
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->user_type == "client") {
                if (!$user->profile_completed)
                    return redirect(route('client.completeProfile'));

                // check if user has assosiated device
                $deviceUser = DeviceUser::where('user_id', '=', $user->id)->first();
                if (!$deviceUser)
                    return redirect('/')->with('message', 'دستگاه متناظر با این کاربر تعریف نشده است.');
            }
            return $next($request);
        } else {
            return redirect('/')->with('message', 'ابتدا باید وارد سیستم شوید.');
        }
    }
}
