<?php
/**
 * Created by PhpStorm.
 * User: quand
 * Date: 7/17/2018
 * Time: 10:57 AM
 */

namespace App\Services\Api\Productions\Admin;


use App\Jobs\SendNotify;
use App\Models\Event;
use App\Models\EventStudent;
use App\Models\User;
use App\Notifications\NotifyEvent;
use App\Services\Api\Interfaces\ManageInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Facades\Excel;

class EventService extends BaseService implements ManageInterface
{
    public function __construct()
    {
        $this->model = new Event();
    }

    public function getAll($inputs)
    {
        if(isset($inputs['size']))
        {
            if($inputs['size'] == -1)
            {
                $events=  Event::paginate(100000);
            }
            else{
                $events = Event::paginate($inputs['size']);
            }

        }
        else{
          $events = Event::paginate(500);
        }
        foreach ($events as $event)
        {
            $event->admin = $event->admin()->select('id','name','avatar')->first();
        }
        return $events;

    }

    public function getOne($id)
    {
        $event = Event::findOrFail($id);
        $event->event_students = $event->event_students;
        $event_students = $event->event_students;
        foreach ($event_students as $item)
        {
            $item->student = $item->student()->select(['code','full_name'])->first();
        }
        $event->event_students = $event_students;
        return $event;
    }

    public function getProfile($option)
    {
        return Event::select($option)->get();
    }

    public function save($inputs)
    {
        $inputs['admin_id'] = Auth::user()->admin->id;
        $event = Event::create($inputs);
        $users = User::where('notify',1)->get();
        if(count($users) > 0)
        {
            foreach ($users as $user)
            {
                $user->notify(new NotifyEvent(['event_id' => $event->id,'title' => $event->title]));
            }
        }
        return $event;
    }
    public function update($inputs, $id)
    {
        try{
            $columns = Schema::getColumnListing((new Event())->getTable());
            $event = Event::findOrFail($id);
            foreach ($columns as $column)
            {
                if(isset($inputs[$column]))
                {
                    $event->$column = $inputs[$column];
                }

            }
            $event->update();
            return $event;
        }catch (\Exception $exception)
        {
            return ['err' => $exception->getMessage()];
        }
    }

    public function updateEventStudent($inputs,$id){
        $eventStudentService = new EventStudentService();
        return $eventStudentService->update($inputs,$id);
    }
    public function destroyEventStudent($id){
        $eventStudentService = new EventStudentService();
        return $eventStudentService->destroy($id);
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();
        return $event;

    }

    public function delete($array)
    {
        $success = $array;
        foreach ($array as $item)
        {
            $event = Event::find($item);
            if($event)
            {
                $event->delete();
                unset($success[$item]);
            }

        }
        return $array;
    }


}