<?php

namespace App\Http\Controllers\Api\Job;

use App\Models\Job;
use App\Services\GetDataService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JobManageController extends Controller
{
    public function index(){
        $jobs = Job::where('accept',1)->select('id','title','description','enterprise_id')->get();
        foreach ($jobs as $job)
        {
            $job->enterprise = $job->enterprise()->select('name','id','address','introduce')->first();
            $job->skills = $job->skills;
            $job->types = $job->types;
            $job->positions = $job->positions;
        }
        return $jobs;

    }

    public function show($id)
    {
        $job= Job::findOrFail($id);
        $job->enterprise = $job->enterprise()->select('name','id','address','introduce')->first();
        $job->skills = $job->skills;
        $job->types = $job->types;
        $job->positions = $job->positions;
        return $job;
    }
}
