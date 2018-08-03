<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\GetDataRequest;
use App\Services\Api\Productions\Admin\ProvinceService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Provincetroller extends Controller
{
    public function index(GetDataRequest $request)
    {
        $service = new ProvinceService();
        return $service->getAll($request->all());
    }
}
