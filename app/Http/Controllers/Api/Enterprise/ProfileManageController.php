<?php

namespace App\Http\Controllers\Api\Enterprise;

use App\Http\Requests\EnterpriseManageRequest;
use App\Http\Requests\UpdateAvatarRequest;
use App\Services\Api\Productions\Enterprise\ProfileService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class ProfileManageController extends Controller
{
    private $profileService;
    public function __construct()
    {

    }
    public function getProfile()
    {
        $user = session('user');
        $enterprise = $user->enterprise;
        $this->profileService = new ProfileService($enterprise->id);
        return $this->profileService->profile();
    }
    public function updateProfile(EnterpriseManageRequest $request)
    {
        $user = session('user');
        $enterprise = $user->enterprise;
        $this->profileService = new ProfileService($enterprise->id);
        return $this->profileService->updateProfile($request->all());
    }
    public function updateAvatar(UpdateAvatarRequest $request)
    {
        $user = session('user');
        $enterprise = $user->enterprise;
        $this->profileService = new ProfileService($enterprise->id);
        return $this->profileService->updateAvatar($request->avatar);
    }
}
