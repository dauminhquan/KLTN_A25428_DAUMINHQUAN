<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Requests\CsvRequest;
use App\Http\Requests\DeleteListRequest;
use App\Http\Requests\GetDataRequest;
use App\Http\Requests\StudentManageRequest;
use App\Http\Requests\UpdateAvatarRequest;
use App\Models\Student;
use App\Services\Api\Productions\Admin\StudentService;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;


class StudentManageController extends Controller
{


    private $studentService;
    public function __construct()
    {
        $this->studentService = new StudentService();
    }

    public function index(GetDataRequest $request)
    {
        return $this->studentService->getAll($request->all());
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

    public function listEnterprise($id)
    {
        return $this->studentService->getListEnterprise($id);
    }

    public function listJob($id){
        return $this->studentService->getListJob($id);
    }

    public function importCsv(CsvRequest $request){
        return $this->studentService->csvStore($request->file('CsvFile')->getRealPath());
    }
    public function getOptionsCsv(CsvRequest $request)
    {
        $data = $this->studentService->getOptionCsv($request->file('CsvFile')->getRealPath(),['id']);
        return response()->download(Excel::create('CodeWithName', function($excel) use($data) {
            $excel->sheet('Sheet1', function($sheet) use($data) {
                $sheet->fromArray($data);
            });
        })->export('csv'));

    }
    public function getUser($id){
        return $this->studentService->getUser($id);
    }
}
