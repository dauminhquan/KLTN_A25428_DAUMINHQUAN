<?php
/**
 * Created by PhpStorm.
 * User: quand
 * Date: 7/16/2018
 * Time: 5:04 PM
 */

namespace App\Services\Api\Productions\Admin;


use App\Models\Task;
use App\Services\Api\Interfaces\ManageInterface;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class TaskService extends BaseService implements ManageInterface
{
    public function __construct()
    {
        $this->model = new Task();
    }
    public function getAll($inputs)
    {

        if(isset($inputs['size']))
        {
            if($inputs['size'] == -1)
            {
                $tasks = Task::paginate(1000000);

            }
            else{
                $tasks = Task::paginate($inputs['size']);
            }
        }
        else{
            $tasks = Task::paginate(500);
        }
        foreach ($tasks as $task)
        {
            // tra ve ten doanh nghiep + avatar
            $task->enterprise = $task->enterprise()->select('name','avatar')->first();
            $task->skills = $task->skills;
            $task->salary = $task->salary;
            $task->positions = $task->positions;
            $task->types = $task->types;
        }
        return $tasks;
    }

    public function getOne($id)
    {
        $task = Task::findOrFail($id);
        $task->skills = $task->skills;
        $task->salary = $task->salary;
        $task->positions = $task->positions;
        $task->types = $task->types;
        return $task;
    }

    public function getProfile($option)
    {
        return Task::select($option)->get();
    }

    public function save($inputs)
    {
        $task = TaskService::create($inputs->all());
        if($inputs->hasFile('attachment'))
        {
            $task->attachment = $inputs->file('attachment')->store('public/attachment');
        }
        $task->skills()->attach($inputs->skills);
        $task->types()->attach($inputs->types);
        $task->positions()->attach($inputs->positions);
        $task->update();
        return $task;
    }

    public function update($inputs, $id)
    {
        try{
            $columns = Schema::getColumnListing((new Task())->getTable());
            $task = Task::findOrFail($id);
            if(isset($inputs['skills']))
            {

                $task->skills()->sync($inputs['skills']);

            }
            if(isset($inputs['types']))
            {
                $task->types()->sync($inputs['types']);

            }
            if(isset($inputs['positions']))
            {
                $task->positions()->sync($inputs['positions']);
            }
            unset($inputs['attachment']);
            foreach ($columns as $column)
            {
                dd($inputs);
                if(isset($inputs[$column]) && $column != 'attachment')
                {
                    $task->$column = $inputs[$column];
                }
            }
            $task->update();
            return $task;
        }catch (\Exception $exception)
        {
            return ['err' => $exception->getMessage()];
        }
    }

    public function updateFileAttach($file,$id)
    {
        try{
            $task = Task::findOrFail($id);
            if(Storage::exists($task->attachment))
            {
                Storage::delete($task->attachment);
            }
            $task->attachment = $file->storeAs('/public/files','file-attach-'.$id.'.'.$file->getClientOriginalName());
            $task->update();
            return $task;
        }catch (\Exception $exception)
        {
            return $exception->getMessage();
        }

    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->types()->detach();
        $task->skills()->detach();
        $task->positions()->detach();
        if(Storage::exists($task->attachment))
        {
            Storage::delete($task->attachment);
        }
        $task->delete();
        return $task;

    }

    public function delete($array)
    {
        $success = $array;
        foreach ($array as $key => $item)
        {
            $task = Task::find($item);
            if($task)
            {
                $task->types()->detach();
                $task->skills()->detach();
                $task->positions()->detach();
                if(Storage::exists($task->attachment))
                {
                    Storage::delete($task->attachment);
                }
                $task->delete();
                unset($success[$key]);
            }
        }
        return $array;
    }
}