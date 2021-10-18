<?php

namespace App\Http\Middleware;

use App\Classes\Enum\Api\User\UserRoleEnum;
use App\Classes\Enum\Api\User\UserStatusEnum;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckActiveUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()->status != UserStatusEnum::ACTIVE) {
            abort(403);
        }

        return $next($request);
    }
}
