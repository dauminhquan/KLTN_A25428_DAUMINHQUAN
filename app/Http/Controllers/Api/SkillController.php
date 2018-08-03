<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\GetDataRequest;
use App\Services\Api\Productions\Admin\SkillService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SkillController extends Controller
{
    public function index(GetDataRequest $request)
    {
        $service = new SkillService();
        return $service->getAll($request->all());
    }
}
