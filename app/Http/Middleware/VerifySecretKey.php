<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifySecretKey
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
        echo $request->headers;
        dd();
        return $next($request);
    }
}
