<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\OauthAccessTokens;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),[
           'user_name' => 'required|exists:users,user_name',
           'password' => 'required'
        ],[
            'user_name.required' => "Không có tài khoản",
            'user_name.exists' => "Tài khoản không tồn tại",
            'password.required' => "Không có mật khẩu"
        ]);
        if($validator->fails())
        {
            return response()->json($validator->errors(),406);
        }

        if(Auth::attempt(['user_name' => $request->user_name,'password' => $request->password]))
        {

            $user = Auth::user();
            $token = $user->token_api;

            if(count($token) >= 5)
            {
                $min_date = OauthAccessTokens::where('user_id',$user->id)->groupBy('user_id')->select('user_id',DB::raw('min(created_at) as mindate'))->first();
                DB::table('oauth_access_tokens')->where('user_id',$min_date->user_id)->
                    where('created_at', $min_date->mindate)->delete();
            }
            $tokenResult = $user->createToken('QuanDau');
            $token = $tokenResult->token;
            $token->expires_at =
                Carbon::now()->addDays(1);

            $token->save();

            $token = $tokenResult->accessToken;
            return response()->json([
                'message' => 'Login Thành công',
                'token' => $token
            ],200);
        }

        return response()->json([
            'message' => 'Mật khẩu không đúng',
        ],406);
    }
    public function logout()
    {
        $user = Auth::user();
        $user->token()->revoke();
        return response()->json([
            'message' => 'Logout thành công',
        ],200);
    }
    public function checkLogin(){
        return ['status' => 1,'message' => 'Đã đăng nhập rồi'];
    }
}
