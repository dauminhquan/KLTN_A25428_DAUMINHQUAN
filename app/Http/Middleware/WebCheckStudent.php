<?php

namespace App\Http\Middleware;

use Closure;

class WebCheckStudent
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
        if(session()->has('user'))
        {
            $user = session('user');
            if($user->type == 3)
            {
                return $next($request);
            }
        }
        return response()->redirectToRoute('web.home');
    }
}
