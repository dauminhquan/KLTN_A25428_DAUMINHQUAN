<?php

namespace App\Http\Controllers\Api\Enterprise;

use App\Http\Requests\RegistrationRequest;
use App\Mail\SendTokenAccept;
use App\Services\Api\Productions\Auth\AuthService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    private $authService;
    public function __construct()
    {
        $this->authService = new AuthService();
    }
    public function registration(RegistrationRequest $request){
        $inputs = $request->all();
        $inputs['email_address'] = $request->email;
        $inputs['password'] = Hash::make($inputs['password']);
        $inputs['type'] = 2;
        return $this->authService->registration($inputs);
    }
    public function reSendAcceptToken(Request $request){
        if($request->has('email'))
        {
            $user = User::where('email',$request->email)->first();
            if($user!= null)
            {
                $token = str_random(50);
                $user->accept_token = $token;
                $user->update();
                Mail::to($user->email)->send((new SendTokenAccept(route('web.accept.user').'?email='.$user->email.'&token='.$token)));
                return [
                  'message' => 'Thanh cong'
                ];
            }
        }
        abort(404);
    }
}
