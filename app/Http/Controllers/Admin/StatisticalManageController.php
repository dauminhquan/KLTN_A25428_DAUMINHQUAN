<?php
/**
 * Created by PhpStorm.
 * User: daumi
 * Date: 17/07/2018
 * Time: 21:38
 */

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Event;

class StatisticalManageController extends Controller
{
    public function index()
    {
        $courses = Course::select(['code','name'])->get();
        $courses= $courses->toArray();
        usort($courses,function($a,$b){
            return (int)substr($a['code'],1) <=> (int)substr($b['code'],1);
        });
        $events = Event::orderByDesc('created_at')->select(['id','title','created_at'])->get();
        $events= $events->toArray();
        foreach ($events as $index => $item)
        {
            $item['created_at'] = date("d-m-Y", strtotime($item['created_at']));
            $events[$index] = $item;
        }
        return view('admin.statistics.index',[
            'courses' => $courses,
            'events' => $events
        ]);
    }

}
