<?php
/**
 * Created by PhpStorm.
 * User: quand
 * Date: 7/16/2018
 * Time: 5:04 PM
 */

namespace App\Services\Api\Productions\Enterprise;


use App\Models\Enterprise;
use App\Models\Task;
use App\Services\Api\Interfaces\ManageInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class TaskService implements ManageInterface
{
    private $enterprise;
    public function __construct()
    {
        $this->enterprise = new Enterprise();
    }

    private function setEnterprise()
    {
        $this->enterprise = Enterprise::find(Auth::user()->enterprise->id);
        if($this->enterprise == null)
        {
            return false;
        }
        return true;
    }

    public function getAll($inputs)
    {
        if($this->setEnterprise() === true)
        {
            if(isset($inputs['size']))
            {
                if('size' == -1)
                {
                    $tasks = $this->enterprise->tasks()->paginate(1000000);
                }
                else{
                    $tasks = $this->enterprise->tasks()->paginate($inputs['size']);
                }
            }
            else{
                $tasks = $this->enterprise->tasks()->paginate(500);
            }
            foreach ($tasks as $task)
            {
                $task->skills = $task->skills;
                $task->salary = $task->salary;
                $task->positions = $task->positions;
                $task->types = $task->types;
            }
            return $tasks;
        }
        return response()->json(['error' => 'user not exists']);
    }

    public function getOne($id)
    {

        if($this->setEnterprise() === true)
        {
            $task = $this->enterprise->tasks()->where('id',$id)->first();
            if($task == null)
            {
                abort_unless(false,404);
            }
            $task->types = $task->types;
            $task->skills = $task->skills;
            $task->positions = $task->positions;
            $task->salary = $task->salary;
            return $task;
        }
        return response()->json(['error' => 'user not exists']);


    }

    public function getProfile($option)
    {
        if($this->setEnterprise() === true)
        {
            return $this->enterprise->tasks()->select($option)->get();
        }
        return response()->json(['error' => 'user not exists']);

    }

    public function save($inputs)
    {

        if($this->setEnterprise() === true)
        {

            $array = $inputs->all();
            $array['enterprise_id']= $this->enterprise->id;
            unset($array['attachment']);
            unset($array['accept']);
            $task = Task::create($array);

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
        return response()->json(['error' => 'user not exists']);

    }

    public function update($inputs, $id)
    {
        if($this->setEnterprise() === true)
        {
            try{
                $task = $this->enterprise->tasks()->where('id',$id)->first();
                if($task == null)
                {
                    abort_unless(false,404);
                }
                $columns = Schema::getColumnListing((new Task())->getTable());
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
        return response()->json(['error' => 'user not exists']);

    }

    public function destroy($id)
    {
        if($this->setEnterprise() === true)
        {
            $task = $this->enterprise->tasks()->where('id',$id)->first();
            if($task == null)
            {
                abort_unless(false,404);
            }

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
        return response()->json(['error' => 'user not exists']);


    }

    public function delete($array)
    {
        if($this->setEnterprise() === true)
        {
            foreach ($array as $item)
            {
                $task = Task::find($item);
                if(!$task->enterprise->id != Auth::user()->enterprise->id)
                {
                    continue;
                }
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
                }
            }
            return $array;
        }
        return response()->json(['error' => 'user not exists']);

    }
    public function updateFileAttach($file,$id)
    {
        if($this->setEnterprise() === true)
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
        return response()->json(['error' => 'user not exists']);


    }
}