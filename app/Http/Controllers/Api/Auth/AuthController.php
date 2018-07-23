<?php
namespace App\Http\Controllers\Api\Auth;


use App\Http\Requests\LoginRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Services\Api\Productions\Auth\AuthService;
use App\Http\Controllers\Controller;


class AuthController extends Controller
{
    private $authService;
    public function __construct()
    {
        $this->authService = new AuthService();
    }
    public function login(LoginRequest $request){
        return ['token' => $this->authService->login($request->all())];
    }
    public function logout()
    {
        $this->authService->logout();
        return ['message' => 'logouted'];
    }
    public function getToken(ResetPasswordRequest $request){
        $timeLimit = $this->authService->getTokenResetPassword($request);
        return ['message' => 'token da duoc gui vao email cua ban. Thời gian hết hạn của token là '.$timeLimit];
    }
    public function resetPassword(ResetPasswordRequest $request)
    {
        if($this->authService->resetPassword($request))
        {
            return ['message' => 'Đổi password thành công'];
        }
        return response()->json(['message' => 'Đã có lỗi xảy ra'],401);
    }

}
