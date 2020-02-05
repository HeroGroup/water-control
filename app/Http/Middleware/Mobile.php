<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class Mobile
{
    public function handle($request, Closure $next)
    {
        try {
            $token = $request->header('api_token');

            if ($token) {
                $user = User::where('api_token', 'LIKE', $token);
                if ($user)
                    $request->userId = $user->first()->id;
                else
                    return abort(419);
            } else {
                return abort(419);
            }
        } catch (\Exception $exception) {
            return abort(419);
        }

        return $next($request);
    }
}
