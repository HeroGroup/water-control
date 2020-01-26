<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->user_type != "admin")
                abort(401);

        } else {
            return 'You need to login first';
        }

        return $next($request);
    }
}
