<?php

namespace App\Http\Controllers\Api\Student;

use App\Http\Requests\StudentManageRequest;
use App\Http\Requests\UpdateAvatarRequest;

use App\Http\Controllers\Controller;
use App\Services\Api\Productions\Student\ProfileService;
use Illuminate\Support\Facades\Auth;


class ProfileManageController extends Controller
{
    private $profileService;
    public function __construct()
    {
        $this->profileService = new ProfileService();
    }
    public function getProfile()
    {
        return $this->profileService->profile();
    }
    public function updateProfile(StudentManageRequest $request)
    {
        return $this->profileService->updateProfile($request->all());
    }
    public function updateAvatar(UpdateAvatarRequest $request)
    {
        return $this->profileService->updateAvatar($request->avatar);
    }

}
