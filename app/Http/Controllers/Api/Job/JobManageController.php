<?php

namespace App\Http\Controllers\Api\Job;

use App\Http\Requests\JobManageRequest;
use App\Models\Job;
use App\Http\Controllers\Controller;

class JobManageController extends Controller
{
    public function index(JobManageRequest $request)
    {
        $jobs = Job::where('accept',1)->select('jobs.id','jobs.title','jobs.description','jobs.enterprise_id')->orderByDesc('jobs.created_at');
        if($request->has('search'))
        {
            $jobs->where('title','like','%'.$request->search.'%');
        }
        if($request->has('types'))
        {
            $jobs->join('job_type','job_type.job_id','jobs.id')->join('types','types.id','job_type.type_id')
                ->whereIn('types.id',$request->types);
        }
        if($request->has('skills'))
        {
            $jobs->join('job_skill','job_skill.job_id','jobs.id')->join('skills','skills.id','job_skill.skill_id')
                ->whereIn('skills.id',$request->skills);
        }
        if($request->has('positions'))
        {
            $jobs->join('job_position','job_position.job_id','jobs.id')->join('positions','positions.id','job_position.position_id')
                ->whereIn('positions.id',$request->positions);
        }
        $jobs = $jobs->paginate(15);
        foreach ($jobs as $index => $job)
        {
            $job->enterprise = $job->enterprise()->select('name','id','address','introduce','avatar')->first();
            $job->skills = $job->skills;
            $job->types = $job->types;
            $job->positions = $job->positions;
        }
        return $jobs;
    }

    public function show($id)
    {
        $job= Job::findOrFail($id);
        if($job->accept != 1)
        {
            return abort(404);
        }
        $job->enterprise = $job->enterprise()->select('name','id','address','introduce','avatar')->first();
        $job->skills = $job->skills;
        $job->types = $job->types;
        $job->salary = $job->salary;
        $job->positions = $job->positions;
        $similars = Job::where('enterprise_id',$job->enterprise_id)->where('accept',1)->where('id','<>',$job->id)->orderByDesc('created_at')->limit(6)->get();
        foreach ($similars as $similar)
        {
            $similar->enterprise = $similar->enterprise()->select('name','id','address','introduce','avatar')->first();
        }
        $job->similars = $similars;
        return $job;
    }

}
