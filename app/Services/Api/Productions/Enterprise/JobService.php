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
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class JobService implements ManageInterface
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
        return response()->json(['error' => 'user not exists']);
    }

    public function getOne($id)
    {

        if($this->setEnterprise() === true)
        {
            $job = $this->enterprise->jobs()->where('id',$id)->first();
            if($job == null)
            {
                abort_unless(false,404);
            }
            $job->types = $job->types;
            $job->skills = $job->skills;
            $job->positions = $job->positions;
            $job->salary = $job->salary;
            return $job;
        }
        return response()->json(['error' => 'user not exists']);


    }

    public function getProfile($option)
    {
        if($this->setEnterprise() === true)
        {
            return $this->enterprise->jobs()->select($option)->get();
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
            $job = Job::create($array);

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
        return response()->json(['error' => 'user not exists']);

    }

    public function update($inputs, $id)
    {
        if($this->setEnterprise() === true)
        {
            try{
                $job = $this->enterprise->jobs()->where('id',$id)->first();
                if($job == null)
                {
                    abort_unless(false,404);
                }
                $columns = Schema::getColumnListing((new Job())->getTable());
                if(isset($inputs['skills']))
                {
                    $job->skills()->sync($inputs['skills']);

                }
                if(isset($inputs['types']))
                {
                    $job->types()->sync($inputs['types']);

                }
                if(isset($inputs['positions']))
                {
                    $job->positions()->sync($inputs['positions']);

                }
                unset($inputs['attachment']);
                unset($inputs['accept']);
                foreach ($columns as $column)
                {
                    $job->$column = $inputs[$column];
                }
                $job->update();
                return $job;
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
        return response()->json(['error' => 'user not exists']);


    }

    public function delete($array)
    {
        if($this->setEnterprise() === true)
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
        return response()->json(['error' => 'user not exists']);

    }
    public function updateFileAttach($file,$id)
    {
        if($this->setEnterprise() === true)
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
        return response()->json(['error' => 'user not exists']);


    }
}