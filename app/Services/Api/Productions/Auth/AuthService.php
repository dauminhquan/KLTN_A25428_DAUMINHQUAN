<?php
/**
 * Created by PhpStorm.
 * User: quand
 * Date: 7/19/2018
 * Time: 2:47 PM
 */

namespace App\Services\Api\Productions\Auth;


use App\Mail\GetTokenResetPassword;
use App\Mail\SendTokenAccept;
use App\Models\Enterprise;
use App\Models\User;
use App\Services\Api\Productions\Admin\BaseService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;

class AuthService extends BaseService /*implements ManageInterface*/
{
    public function login($inputs)
    {
        if(Auth::attempt($inputs))
        {
            $user = Auth::user();
            $tokens = $user->tokens;
            foreach($tokens as $token) {
                $token->revoke();
            }
            $connect = Redis::connection();
            $connect->publish('message',json_encode([
                'login' => [
                    'id' => $user->id
                ]
            ]));
            session(['user'=>$user]);
//            $user->notify(new NotifyEvent(['log' => true]));
            return response()->json([
                'token' => $user->createToken('QuanDau')->accessToken,
                'user' => $user
            ]);
        }
        return response()->json(['password' => 'password không chính xác'],406);
    }
    public function logout($request)
    {
        $user = $request->user();
        $tokens = $user->tokens;
        foreach ($tokens as $token)
        {
            $token->revoke();
        }
        session()->remove('user');
        return ['message' => 'logouted'];

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
        if($inputs['type'] == 2)
        {
            $enterprise = Enterprise::create($inputs);
            $enterprise->user_id = $user->id;
            $enterprise->update();
        }
        $token = str_random(50);
        $timeLimit = $user->time_limit = now()->addMinute(15);
        $user->accept_token = $token;
        $user->update();
        Mail::to($user->email)->send((new SendTokenAccept(route('web.accept.user').'?email='.$user->email.'&token='.$token,$timeLimit)));
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