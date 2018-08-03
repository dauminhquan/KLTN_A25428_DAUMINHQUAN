<?php
namespace App\Http\Controllers\Api\Auth;


use App\Http\Requests\LoginRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Services\Api\Productions\Auth\AuthService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    private $authService;
    public function __construct()
    {
        $this->authService = new AuthService();
    }
    public function login(LoginRequest $request){
        return $this->authService->login($request->all());
    }
    public function logout(Request $request)
    {
        $this->authService->logout($request);
        return ['message' => 'logouted'];
    }
    public function getToken(ResetPasswordRequest $request){
        $timeLimit = $this->authService->getTokenResetPassword($request);
        return ['message' => 'Mã đã được gửi vào Email của bạn, vui lòng kiểm tra Email. Thời gian hết hạn của mã là '.$timeLimit];
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
