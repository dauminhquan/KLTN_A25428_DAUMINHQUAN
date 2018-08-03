<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Console\Parser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(){
        if(session()->has('user'))
        {
            $user = session('user');
            $user = User::where('email',$user->email)->first();
            if($user != null && $user->authentication == 1)
            {
                session(['user' => $user]);
                return response()->redirectToRoute('web.home');
            }
        }
        session()->remove('user');
        return view('auth.login');
    }
}
