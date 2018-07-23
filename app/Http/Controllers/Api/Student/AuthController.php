<?php

namespace App\Http\Controllers\Api\Student;

use App\Http\Requests\RegistrationRequest;
use App\Services\Api\Productions\Auth\AuthService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    private $authService;
    public function __construct()
    {
        $this->authService = new AuthService();
    }
    public function registration(RegistrationRequest $request){
        $inputs = $request->all();
        $inputs['password'] = Hash::make($inputs['password']);
        $inputs['type'] = 3;
        return $this->authService->registration($inputs);
    }
}
