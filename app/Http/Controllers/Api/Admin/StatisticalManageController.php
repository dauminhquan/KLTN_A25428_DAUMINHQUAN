<?php

namespace App\Http\Controllers\Api\Admin;


use App\Models\Course;
use App\Models\Department;
use App\Models\Event;
use App\Models\EventStudent;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatisticalManageController extends Controller
{
    public function graduateStatistics(Request $request){
        if($request->has('course_codes')) {
            $course_codes = $request->course_codes;
            $course_names = [];
            $courses = [];
            if(gettype($course_codes) == 'array')
            {
                foreach ($course_codes as $course_code)
                {
                    $course = Course::findOrFail($course_code);
                    $course_names[] = [
                        'code' => $course->code,
                        'name' => $course->name
                    ];
                    $courses[] = $course;
                }
                $departments = Department::all();
                $data = [];

                foreach ($departments as $department)
                {
                    $counts = [];
                    foreach ($courses as $course)
                    {
                        $counts[] = Student::join('branches','branches.code','students.branch_code')->join('departments','departments.code','branches.department_code')
                            ->where('departments.code',$department->code)
                            ->where('students.course_code',$course->code)
                            ->where('students.graduated',1)->count();
                    }
                    $data[] = [
                        'count' => $counts,
                        'department' => $department->name,
                    ];
                }
                return [
                    'course_names' => $course_names,
                    'data'=> $data
                ];
            }
        }
        //thống kê tốt nghiệp theo khoa và theo khóa
        // lấy danh sách tất cả các khoa


    }
    public function eventStatistics()
    {
        $events = Event::orderByDesc('created_at')->limit(10)->get();
        // ten event
        // so luong nguoi dang ky
        // so luong nguoi khong di
        $listName = [];
        foreach ($events as $event)
        {
            $listName[] = $event->title;
        }
        $go = [];
        $notgo = [];
        foreach ($listName as $item)
        {
            foreach ($events as $event)
            {
                if($event->title == $item)
                {
                    $go[] = EventStudent::where('event_id',$event->id)->where('attended',1)->count();
                    $notgo[] = EventStudent::where('event_id',$event->id)->where('attended',0)->count();
                }
            }
        }
        return [
          'listName' => $listName,
          'go' => $go,
          'notgo' => $notgo
        ];
    }
}
