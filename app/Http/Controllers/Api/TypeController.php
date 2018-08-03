<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\GetDataRequest;
use App\Services\Api\Productions\Admin\TypeService;
use App\Http\Controllers\Controller;

class TypeController extends Controller
{
    public function index(GetDataRequest $request)
    {
        $service = new TypeService();
        return $service->getAll($request->all());
    }
}
