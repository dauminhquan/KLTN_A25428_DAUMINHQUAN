<?php
/**
 * Created by PhpStorm.
 * User: quand
 * Date: 7/19/2018
 * Time: 2:47 PM
 */

namespace App\Services\Api\Productions\Auth;


use App\Mail\GetTokenResetPassword;
use App\Models\User;
use App\Services\Api\Interfaces\ManageInterface;
use App\Services\Api\Productions\Admin\BaseService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthService extends BaseService /*implements ManageInterface*/
{
    public function login($inputs)
    {
        if(Auth::attempt($inputs))
        {
            $user = Auth::user();

            return $user->createToken('QuanDau');
        }
    }
    public function logout()
    {
        $user = Auth::user();
        $user->token()->revoke();
        Auth::logout();

    }
    public function getTokenResetPassword($inputs)
    {
        $user = User::where('email',$inputs->email)->first();
        $token = str_random(8);
        $timeLimit = $user->time_limit = now()->addMinute(15);
        $user->reset_token = $token;
        $user->update();
        Mail::to($user->email)->send((new GetTokenResetPassword($user->email,$token,$timeLimit)));
        return $timeLimit;
    }
    public function registration($inputs)
    {
        $user = User::create($inputs);
//        $token = str_random(8);
        return $user;
    }
    public function resetPassword($inputs) :bool
    {
        try{
            $user = User::where('email',$inputs->email)->first();
            if($user->time_limit == null)
            {
                return false;
            }
            $timeLimit = Carbon::createFromTimeString($user->time_limit);

            if($user->reset_token == $inputs->token && !$timeLimit->isPast())
            {
                $user->password = Hash::make($inputs->password);
                $user->time_limit = null;
                $user->reset_token = null;
                $user->update();
                return true;
            }

        }catch(\Exception $exception)
        {
            return false;
        }
        return false;
    }
}