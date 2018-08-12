<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\GetDataRequest;
use App\Models\Event;
use App\Models\EventStudent;
use App\Notifications\NotifyEvent;
use App\Services\Api\Productions\Admin\EventService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class EventController extends Controller
{
    public function index(GetDataRequest $request)
    {
        $service = new EventService();
        return $service->getAll($request->all());
    }
    public function show($id)
    {
        $event= Event::findOrFail($id);
        $event->admin = $event->admin()->select('name','id','avatar')->first();
        $user = Auth::user();
        $student = $user->student;
        if($student != null)
        {
            $event->joined = 0;
            $students = $event->students;
            foreach ($students as $item)
            {
                if($item->code == $student->code)
                {
                    $event->joined = 1;
                    break;
                }
            }
        }
        $similars = Event::where('admin_id',$event->admin_id)->where('id','<>',$event->id)->orderByDesc('created_at')->limit(6)->get();
        foreach ($similars as $similar)
        {
            $similar->admin = $similar->admin()->select('name','id','avatar')->first();
        }
        $event->similars = $similars;
        return $event;
    }
    public function registrationNotify(){
        $user = Auth::user();
        $user->notify = 1;
        $user->update();
        $connect = Redis::connection();
        $connect->publish('message',json_encode([
            'reg_event' => [
                'id' => $user->id
            ]
        ]));
        return $user;
    }
    public function unRegistrationNotify(){
        $user = Auth::user();
        $user->notify = 0;
        $user->update();
        $connect = Redis::connection();
        $connect->publish('message',json_encode([
            'un_reg_event' => [
                'id' => $user->id
            ]
        ]));
        return $user;
    }
    public function joinEvent($id){
        $student = Auth::user()->student;
        if($student != null)
        {
            $check = EventStudent::where('student_code',$student->code)->where('event_id',$id)->first();
            if($check != null)
            {
                return response()->json(['message' => 'Lỗi'],404);
            }
            $e_v = new EventStudent();
            $e_v->event_id = $id;
            $e_v->student_code = $student->code;
            $e_v->save();
            return ['message' => 'Thành công'];
        }
        return response()->json(['message' => 'Lỗi'],404);
    }
    public function unJoinEvent($id){
        $student = Auth::user()->student;
        if($student != null)
        {
            $e_v = EventStudent::where('student_code',$student->code)->where('event_id',$id)->first();
            if($e_v == null)
            {
                return response()->json(['message' => 'Lỗi'],404);
            }
            $e_v->delete();
            return ['message' => 'Thành công'];
        }
        return response()->json(['message' => 'Lỗi'],404);
    }
}
