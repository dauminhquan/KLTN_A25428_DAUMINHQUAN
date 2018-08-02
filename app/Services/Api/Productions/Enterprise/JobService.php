<?php
/**
 * Created by PhpStorm.
 * User: quand
 * Date: 7/16/2018
 * Time: 5:04 PM
 */

namespace App\Services\Api\Productions\Enterprise;


use App\Models\Enterprise;
use App\Models\Job;
use App\Services\Api\Interfaces\ManageInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class JobService implements ManageInterface
{
    private $enterprise;
    public function __construct($id)
    {
        $this->enterprise = Enterprise::findOrFail($id);
    }

    public function getAll($inputs)
    {
        if(isset($inputs['size']))
        {
            if('size' == -1)
            {
                $jobs = $this->enterprise->jobs()->paginate(1000000);
            }
            else{
                $jobs = $this->enterprise->jobs()->paginate($inputs['size']);
            }
        }
        else{
            $jobs = $this->enterprise->jobs()->paginate(500);
        }
        foreach ($jobs as $job)
        {
            $job->skills = $job->skills;
            $job->salary = $job->salary;
            $job->positions = $job->positions;
            $job->types = $job->types;
        }
        return $jobs;

    }

    public function getOne($id)
    {
        $job = $this->enterprise->jobs()->where('id',$id)->first();
        if($job == null)
        {
            abort_unless(false,404);
        }
        $job->types = $job->types()->select('name')->get();
        $job->skills = $job->skills->select('name')->get();
        $job->positions = $job->positions->select('name')->get();
        return $job;
    }

    public function getProfile($option)
    {
        return $this->enterprise->jobs()->select($option)->get();
    }

    public function save($inputs)
    {

        $inputs->enterprise_id = Auth::user()->enterprise->id;
        $job = JobService::create($inputs->all());

        if($inputs->hasFile('attachment'))
        {
            $job->attachment = $inputs->file('attachment')->store('public/attachment');
        }
        $job->skills()->attach($inputs->skills);
        $job->types()->attach($inputs->types);
        $job->positions()->attach($inputs->positions);
        $job->update();
        return $job;
    }

    public function update($inputs, $id)
    {
        try{
            $job = $this->enterprise->jobs()->where('id',$id)->first();
            if($job == null)
            {
                abort_unless(false,404);
            }
            $columns = Schema::getColumnListing((new Job())->getTable());

            foreach ($columns as $column)
            {
                if($column == 'skills')
                {
                    $job->skills()->sync($inputs[$column]);
                    continue;
                }
                if($column == 'types')
                {
                    $job->types()->sync($inputs[$column]);
                    continue;
                }
                if($column == 'positions')
                {
                    $job->positions()->sync($inputs[$column]);
                    continue;
                }
                else if(isset($inputs[$column]))
                {
                    $job->$column = $inputs[$column];
                }


            }
            $job->update();
            return $job;
        }catch (\Exception $exception)
        {
            return ['err' => $exception->getMessage()];
        }
    }

    public function destroy($id)
    {
        $job = $this->enterprise->jobs()->where('id',$id)->first();
        if($job == null)
        {
            abort_unless(false,404);
        }

        $job->types()->detach();
        $job->skills()->detach();
        $job->positions()->detach();
        if(Storage::exists($job->attachment))
        {
            Storage::delete($job->attachment);
        }
        $job->delete();
        return $job;

    }

    public function delete($array)
    {
        foreach ($array as $item)
        {
            $job = Job::find($item);
            if(!$job->enterprise->id != Auth::user()->enterprise->id)
            {
                continue;
            }
            if($job)
            {
                $job->types()->detach();
                $job->skills()->detach();
                $job->positions()->detach();
                if(Storage::exists($job->attachment))
                {
                    Storage::delete($job->attachment);
                }
                $job->delete();
            }
        }
        return $array;
    }
    public function updateFileAttach($file,$id)
    {
        try{
            $job = Job::findOrFail($id);
            if(Storage::exists($job->attachment))
            {
                Storage::delete($job->attachment);
            }
            $job->attachment = $file->storeAs('/public/files','file-attach-'.$id.'.'.$file->getClientOriginalName());
            $job->update();
            return $job;
        }catch (\Exception $exception)
        {
            return $exception->getMessage();
        }

    }
}