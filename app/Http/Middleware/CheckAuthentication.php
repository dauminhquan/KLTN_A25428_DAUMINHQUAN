<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;

class CheckAuthentication
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
            $user = User::where('email',$user->email)->first();
            if($user != null && $user->authentication == 1)
            {
                session(['user' => $user]);
                return $next($request);
            }
        }
        session()->remove('user');
        return response()->redirectToRoute('web.login');
    }
}
