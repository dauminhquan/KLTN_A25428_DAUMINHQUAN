<?php
/**
 * Created by PhpStorm.
 * User: quand
 * Date: 7/17/2018
 * Time: 10:57 AM
 */

namespace App\Services\Api\Productions\Admin;


use App\Models\EventStudent;
use App\Services\Api\Interfaces\ManageInterface;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Facades\Excel;

class EventStudentService extends BaseService implements ManageInterface
{
    public function __construct()
    {
        $this->model = new EventStudent();
    }

    public function getAll($inputs)
    {
        if(isset($inputs['size']))
        {
            if($inputs['size'] == -1)
            {
                $eventStudents = EventStudent::paginate(100000);
            }
            else{
                $eventStudents = EventStudent::paginate($inputs['size']);
            }
        }else{
            $eventStudents = EventStudent::paginate(500);
        }
       foreach ($eventStudents as $eventStudent)
       {
           $eventStudent->student = $eventStudent->student()->select(['code','full_name'])->first();
           $eventStudent->event = $eventStudent->event()->select(['id','title'])->first();
       }
        return $eventStudents;
    }

    public function getOne($id)
    {
        $eventStudent = EventStudent::findOrFail($id);
        $eventStudent->student = $eventStudent->student()->select(['code','full_name'])->first();
        $eventStudent->event = $eventStudent->event()->select(['id','title'])->first();
        return $eventStudent;
    }

    public function getProfile($option)
    {
        return EventStudent::select($option)->get();
    }

    public function save($inputs)
    {
        $eventStudent = EventStudent::create($inputs);
        return $eventStudent;
    }

    public function update($inputs, $id)
    {

        try{
            $columns = Schema::getColumnListing((new EventStudent())->getTable());
            $eventStudent = EventStudent::findOrFail($id);
            foreach ($columns as $column)
            {
                if(array_key_exists($column,$inputs))
                {
                    $eventStudent->$column = $inputs[$column];
                }

            }
            $eventStudent->update();
            return $eventStudent;
        }catch (\Exception $exception)
        {
            return ['err' => $exception->getMessage()];
        }
    }

    public function destroy($id)
    {
        $eventStudent = EventStudent::findOrFail($id);
        $eventStudent->delete();
        return $eventStudent;

    }

    public function delete($array)
    {
        $success = $array;
        foreach ($array as $item)
        {
            $eventStudent = EventStudent::find($item);

            if($eventStudent)
            {
                $eventStudent->delete();
                unset($success[$item]);
            }

        }
        return $array;
    }

    public function csvStore($path){
        $list_err = [];
        $data = Excel::load($path,function($reader){})->get()->toArray();

        if(count($data) > 0)
        {
            foreach ($data as $item)
            {
                try{
                    if(EventStudent::where('student_code',$item['student_code'])->where('event_id',$item['event_id'])->first() != null)
                    {
                        $list_err[] = [
                            'error' => $item['student_code'],
                            'message' => 'Sinh viên này đã đăng ký trước đó'
                        ];
                    }
                    else{
                        EventStudent::create($item);
                    }
                }catch (\Exception $exception)
                {
                    $list_err[] = [
                        'error' => $exception->getCode(),
                        'message' => $exception->getMessage()
                    ];
                }
            }
        }
        if(count($list_err) == count($data))
        {
            return response()->json([
                'message' => "File rỗng | Sai định dạng | Trùng dữ liệu toàn bộ",
                'error' => $list_err
            ],422);
        }
        return [
            'message' => 'Thành công',
            'error' => $list_err
        ];
    }

    public function csvUpdate($path){
        $list_err = [];
        $data = Excel::load($path,function($reader){})->get()->toArray();

        if(count($data) > 0)
        {
            foreach ($data as $item)
            {
                try{

                    $event_student = EventStudent::where('student_code',$item['student_code'])->where('event_id',$item['event_id'])->first();

                    if($event_student == null)
                    {
                        EventStudent::create($item);
                    }
                    else{
                        $event_student->update($item);
                    }
                }catch (\Exception $exception)
                {
                    $list_err[] = [
                        'error' => $exception->getCode(),
                        'message' => $exception->getMessage()
                    ];
                }
            }
        }
        if(count($list_err) == count($data))
        {
            return response()->json([
                'message' => "File rỗng | Sai định dạng | Trùng dữ liệu toàn bộ",
                'error' => $list_err
            ],422);
        }
        return [
            'message' => 'Thành công',
            'error' => $list_err
        ];
    }
}
