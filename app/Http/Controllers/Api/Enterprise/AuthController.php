<?php

namespace App\Http\Controllers\Api\Enterprise;

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
        $inputs['email_address'] = $request->email;
        $inputs['password'] = Hash::make($inputs['password']);
        $inputs['type'] = 2;
        return $this->authService->registration($inputs);
    }
}
