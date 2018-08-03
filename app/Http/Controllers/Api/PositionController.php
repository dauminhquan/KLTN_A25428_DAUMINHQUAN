<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\GetDataRequest;
use App\Services\Api\Productions\Admin\PositionService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PositionController extends Controller
{
    public function index(GetDataRequest $request)
    {
        $service = new PositionService();
        return $service->getAll($request->all());
    }
}
