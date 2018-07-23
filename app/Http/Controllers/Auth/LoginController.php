<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Console\Parser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(){
        return view('auth.login');
    }
    public function post_login(Request $request)
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

        if(Auth::guard('web')->attempt(['user_name' => $request->user_name,'password' => $request->password]))
        {

            return response()->json([
                'message' => 'Login Thành công'
            ],200);

        }

        return response()->json([
            'message' => 'Mật khẩu không đúng',
        ],406);
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return ['status' => 1,'message' => 'Bạn đã logout thành công'];
    }
}
