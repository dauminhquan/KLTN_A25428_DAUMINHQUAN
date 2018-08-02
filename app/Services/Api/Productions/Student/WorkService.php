<?php
/**
 * Created by PhpStorm.
 * User: quand
 * Date: 7/17/2018
 * Time: 5:20 PM
 */

namespace App\Services\Api\Productions\Student;


use App\Models\Student;
use App\Models\Work;
use App\Services\Api\Interfaces\ManageInterface;
use Illuminate\Support\Facades\Auth;

class WorkService implements ManageInterface
{
    private $student;
    public function __construct()
    {
        $this->student = Student::findOrFail(Auth::user()->student);
    }
    public function getAll()
    {
        return $this->student->works;
    }

    public function getOne($id)
    {
        $work = $this->student->works()->where('id',$id)->first();
        if($work == null)
        {
            abort_unless(false,404);
        }
        $work->enterprise = $work->enterprise;
        $work->student = $work->student;
        $work->salary = $work->salary;
        $work->rank = $work->rank;
        return $work;
    }

    public function getProfile($option)
    {
        return $this->student->works()->select($option)->get();
    }

    public function save($inputs)
    {

        $work = WorkService::create($inputs->all());
        return $work;
    }

    public function update($inputs, $id)
    {
        try{
            $columns = Schema::getColumnListing((new Work())->getTable());
            $work = Work::findOrFail($id);
            foreach ($columns as $column)
            {
                $work->$column = $inputs[$column];

            }
            $work->update();
            return $work;
        }catch (\Exception $exception)
        {
            return ['err' => $exception->getMessage()];
        }
    }

    public function destroy($id)
    {
        $work = Work::findOrFail($id);
        $work->delete();
        return $work;

    }

    public function delete($array)
    {
        foreach ($array as $item)
        {
            $work = Work::find($item);
            if($work)
            {
                $work->delete();
            }
        }
        return $array;
    }

    public function csvStore($path){
        $list_err = [];

        $data = Excel::load($path,function($reader){})->get()->toArray();
        if(count($data) > 0)
        {
            foreach ($data as $item)
            {

                try{
                    Work::create($item);
                }catch (\Exception $exception)
                {
                    $list_err[] = [
                        'error' => $exception->getCode(),
                        'message' => $exception->getMessage()
                    ];
                }
            }
        }
        if(count($list_err) == count($data))
        {
            return response()->json([
                'message' => "File rỗng | Sai định dạng | Trùng dữ liệu toàn bộ",
                'error' => $list_err
            ],406);
        }
        return [
            'message' => 'Thêm danh sách doanh nghiệp thành công',
            'error' => $list_err
        ];
    }
}