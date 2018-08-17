<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        return view('events.index');
    }
    public function info($id)
    {
        $event = Event::findOrFail($id);
        if($event->status == 3)
        {
            return abort(404);
        }
        $event->admin = $event->admin;
        return view('events.info',['id' => $id]);
    }
}
