<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class Mobile
{
    public function handle($request, Closure $next)
    {
        try {
            $token = $request->header('token');

            if ($token) {
                $user = User::where('api_token', 'LIKE', $token);
            }
        } catch (\Exception $exception) {
            //
        }

        return $next($request);
    }
}
