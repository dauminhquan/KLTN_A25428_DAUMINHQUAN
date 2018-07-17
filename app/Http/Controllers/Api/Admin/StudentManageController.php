<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Requests\CsvRequest;
use App\Http\Requests\DeleteListRequest;
use App\Http\Requests\ExcelFile;

use App\Http\Requests\UpdateAvatarRequest;
use App\Models\Student;
use App\Services\Api\Productions\Admin\StudentService;
use App\Services\DeleteDataService;
use App\Services\GetDataService;
use App\Services\InsertDataFromExcelService;
use App\Services\InsertDataService;
use App\Services\UpdateDataService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class StudentManageController extends Controller
{


    private $studentService;
    public function __construct()
    {
        $this->studentService = new StudentService();
    }

    public function index()
    {
        return $this->studentService->getAll();
    }

    public function store(StudentManageRequest $request)
    {
        $student = Student::create($request->all());
        return $student;
    }

    public function show($id)
    {
        return $this->studentService->getOne($id);
    }

    public function update(Request $request, $id)
    {
        return $this->studentService->update($request->all(),$id);
    }

    public function destroy($id)
    {
        return $this->studentService->destroy($id);
    }

    public function delete(DeleteListRequest $request){

        return $this->studentService->delete($request->id_list);
    }

    public function updateAvatar(UpdateAvatarRequest $request,$id)
    {
        return $this->studentService->updateAvatar($id,$request->file('avatar'));
    }

    public function listStudent($id)
    {
        return $this->studentService->getListStudent($id);
    }

    public function listJob($id){
        return $this->studentService->getListJob($id);
    }

    public function importCsv(CsvRequest $request){
        return $this->studentService->csvStore($request->file('CsvFile')->getRealPath());
    }
}
