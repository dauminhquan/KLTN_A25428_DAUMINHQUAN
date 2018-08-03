<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class WebCheckAdmin
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
        $user = session('user');
        if(session()->has('user'))
        {
            $user = session('user');
            if($user->type == 1)
            {
                return $next($request);
            }
        }
        return response()->redirectToRoute('web.home');
    }
}
