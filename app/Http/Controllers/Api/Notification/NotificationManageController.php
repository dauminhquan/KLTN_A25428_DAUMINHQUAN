<?php

namespace App\Http\Controllers\Api\Notification;

use App\Models\Notification;

use App\Http\Controllers\Controller;

class NotificationManageController extends Controller
{
    public function index()
    {
        $notifications = Notification::select('id','title','description','enterprise_id')->get();
        foreach ($notifications as $notification)
        {
            $notification->admin = $notification->admin()->select('id')->first();
        }
        return $notifications;
    }

    public function show($id)
    {
        $notification= Notification::findOrFail($id);
        $notification->admin = $notification->admin()->select('id')->first();
        return $notification;
    }
}
