<?php
/**
 * Created by PhpStorm.
 * User: quand
 * Date: 7/16/2018
 * Time: 5:04 PM
 */

namespace App\Services\Api\Productions\Admin;


use App\Models\Job;
use App\Services\Api\Interfaces\ManageInterface;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class JobService extends BaseService implements ManageInterface
{
    public function __construct()
    {
        $this->model = new Job();
    }
    public function getAll($inputs)
    {

        if(isset($inputs['size']))
        {
            if('size' == -1)
            {
                $jobs = Job::get();
                foreach ($jobs as $job)
                {
                    // tra ve ten doanh nghiep + avatar
                    $job->enterprise = $job->enterprise()->select('name','avatar')->first();
                    $job->skills = $job->skills;
                    $job->salary = $job->salary;
                    $job->positions = $job->positions;
                    $job->types = $job->types;
                }
                return $jobs;
            }
            $jobs = Job::paginate($inputs['size']);
            foreach ($jobs as $job)
            {
                // tra ve ten doanh nghiep + avatar
                $job->enterprise = $job->enterprise()->select('name','avatar')->first();
                $job->skills = $job->skills;
                $job->salary = $job->salary;
                $job->positions = $job->positions;
                $job->types = $job->types;
            }
        }
        $jobs = Job::paginate(500);
        foreach ($jobs as $job)
        {
            // tra ve ten doanh nghiep + avatar
            $job->enterprise = $job->enterprise()->select('name','avatar')->first();
            $job->skills = $job->skills;
            $job->salary = $job->salary;
            $job->positions = $job->positions;
            $job->types = $job->types;
        }
        return $jobs;
    }

    public function getOne($id)
    {
        $job = Job::findOrFail($id);
        $job->skills = $job->skills;
        $job->salary = $job->salary;
        $job->positions = $job->positions;
        $job->types = $job->types;
        return $job;
    }

    public function getProfile($option)
    {
        return Job::select($option)->get();
    }

    public function save($inputs)
    {
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
            $columns = Schema::getColumnListing((new Job())->getTableName());
            $job = Job::findOrFail($id);
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
            foreach ($columns as $column)
            {

                if(isset($inputs[$column]) && $column != 'file_attach')
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

    public function destroy($id)
    {
        $job = Job::findOrFail($id);
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
        $success = $array;
        foreach ($array as $key => $item)
        {
            $job = Job::find($item);
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
                unset($success[$key]);
            }
        }
        return $array;
    }
}