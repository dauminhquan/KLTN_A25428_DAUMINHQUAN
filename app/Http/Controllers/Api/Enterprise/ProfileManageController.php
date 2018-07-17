<?php

namespace App\Http\Controllers\Api\Enterprise;

use App\Http\Requests\EnterpriseManageRequest;
use App\Http\Requests\UpdateAvatarRequest;
use App\Services\Api\Productions\Enterprise\ProfileService;
use App\Http\Controllers\Controller;


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
    public function updateProfile(EnterpriseManageRequest $request)
    {
        return $this->profileService->updateProfile($request->all());
    }
    public function updateAvatar(UpdateAvatarRequest $request)
    {
        return $this->profileService->updateAvatar($request->avatar);
    }
}
