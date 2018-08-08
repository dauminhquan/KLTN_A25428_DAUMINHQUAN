<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAccepUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::user()->authentication != 1)
        {
            session('user')->remove();
            return response()->json(['message' => 'Tài khoản chưa được xác thực hoặc đang bị khóa'],401);
        }
        return $next($request);
    }
}
