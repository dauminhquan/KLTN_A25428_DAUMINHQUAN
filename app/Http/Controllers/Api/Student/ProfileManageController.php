<?php

namespace App\Http\Controllers\Api\Student;

use App\Http\Requests\UpdateAvatarRequest;
use App\Models\Employee;
use App\Models\Enterprise;
use App\Models\User;
use App\Services\DeleteDataService;
use App\Services\GetDataService;
use App\Services\InsertDataFromExcelService;
use App\Services\InsertDataService;
use App\Services\UpdateDataService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
