<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\GetDataRequest;
use App\Models\Notification;
use App\Services\Api\Productions\Admin\NotificationService;
use App\Http\Controllers\Controller;

class NotifyController extends Controller
{
    public function index(GetDataRequest $request)
    {
        $service = new NotificationService();
        return $service->getAll($request->all());
    }
    public function show($id)
    {

        $notify= Notification::findOrFail($id);
        $notify->admin = $notify->admin()->select('name','id')->first();
        $similars = Notification::where('admin_id',$notify->admin_id)->where('id','<>',$notify->id)->orderByDesc('created_at')->limit(6)->get();
        foreach ($similars as $similar)
        {
            $similar->admin = $similar->admin()->select('name','id')->first();
        }
        $notify->similars = $similars;
        return $notify;
    }
}
