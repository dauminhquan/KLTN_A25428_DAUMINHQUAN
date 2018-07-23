<?php

namespace App\Http\Controllers\Api\Enterprise;

use App\Services\Api\Productions\Enterprise\JobService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class JobManageController extends Controller
{
    private $jobService;
    public function __construct()
    {
//        Auth::user()->id
        $this->jobService = new JobService(1);
    }
    public function index()
    {
        return $this->jobService->getAll();
    }

    public function show($id)
    {
        return $this->jobService->getOne($id);
    }

    public function update(Request $request, $id)
    {
        return $this->jobService->update($request->all(),$id);
    }

    public function destroy($id)
    {
        return $this->jobService->destroy($id);
    }

    public function delete(DeleteListRequest $request){

        return $this->jobService->delete($request->id_list);
    }
}
