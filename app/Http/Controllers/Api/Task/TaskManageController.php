<?php

namespace App\Http\Controllers\Api\Task;

use App\Http\Requests\TaskManageRequest;
use App\Models\Task;
use App\Http\Controllers\Controller;

class TaskManageController extends Controller
{
    public function index(TaskManageRequest $request)
    {
        $tasks = Task::where('accept',1)->select('tasks.id','tasks.title','tasks.description','tasks.enterprise_id')->orderByDesc('tasks.created_at');
        if($request->has('search'))
        {
            $tasks->where('title','like','%'.$request->search.'%');
        }
        if($request->has('types'))
        {
            $tasks->join('task_type','task_type.task_id','tasks.id')->join('types','types.id','task_type.type_id')
                ->whereIn('types.id',$request->types);
        }
        if($request->has('skills'))
        {
            $tasks->join('task_skill','task_skill.task_id','tasks.id')->join('skills','skills.id','task_skill.skill_id')
                ->whereIn('skills.id',$request->skills);
        }
        if($request->has('positions'))
        {
            $tasks->join('task_position','task_position.task_id','tasks.id')->join('positions','positions.id','task_position.position_id')
                ->whereIn('positions.id',$request->positions);
        }
        $tasks = $tasks->paginate(15);
        foreach ($tasks as $index => $task)
        {
            $task->enterprise = $task->enterprise()->select('name','id','address','introduce','avatar')->first();
            $task->skills = $task->skills;
            $task->types = $task->types;
            $task->positions = $task->positions;
        }
        return $tasks;
    }

    public function show($id)
    {
        $task= Task::findOrFail($id);
        if($task->accept != 1)
        {
            return abort(404);
        }
        $task->enterprise = $task->enterprise()->select('name','id','address','introduce','avatar')->first();
        $task->skills = $task->skills;
        $task->types = $task->types;
        $task->salary = $task->salary;
        $task->positions = $task->positions;
        $similars = Task::where('enterprise_id',$task->enterprise_id)->where('accept',1)->where('id','<>',$task->id)->orderByDesc('created_at')->limit(6)->get();
        foreach ($similars as $similar)
        {
            $similar->enterprise = $similar->enterprise()->select('name','id','address','introduce','avatar')->first();
        }
        $task->similars = $similars;
        return $task;
    }

}
