<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\GetDataRequest;
use App\Services\Api\Productions\Admin\NotificationService;
use App\Http\Controllers\Controller;

class NotifyController extends Controller
{
    public function index(GetDataRequest $request)
    {
        $service = new NotificationService();
        return $service->getAll($request->all());
    }
}
