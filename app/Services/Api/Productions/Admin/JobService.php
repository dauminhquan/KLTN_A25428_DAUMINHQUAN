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

class JobService implements ManageInterface
{

    public function getAll()
    {
        $jobs = Job::all();
        foreach ($jobs as $job)
        {
            // tra ve ten doanh nghiep + avatar
            $job->enterprise = $job->enterprise()->select('name','avatar')->first();
            $job->skills = $job->skills()->all();
            $job->salary = $job->salary()->first();
            $job->positions = $job->positions()->all();
            $job->types = $job->types()->all();
        }
        return $jobs;
    }

    public function getOne($id)
    {
        $job = Job::findOrFail($id);
        $job->enterprise = $job->enterprise()->select('name','avatar')->first();
        $job->skills = $job->skills()->all();
        $job->salary = $job->salary()->first();
        $job->positions = $job->positions()->all();
        $job->types = $job->types()->all();
        return $job;
    }

    public function getProfile($option)
    {
        return Job::select($option)->get();
    }

    public function save($inputs)
    {
        $job = JobService::create($inputs->all());
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
        $job = Job::findOrFail($id);
        $job->types()->detach();
        $job->skills()->detach();
        $job->positions()->detach();

        $job->delete();
        return $job;

    }

    public function delete($array)
    {
        foreach ($array as $item)
        {
            $job = Job::find($item);
            if($job)
            {
                $job->types()->detach();
                $job->skills()->detach();
                $job->positions()->detach();

                $job->delete();
            }
        }
        return $array;
    }
}