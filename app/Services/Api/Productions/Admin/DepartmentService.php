<?php
/**
 * Created by PhpStorm.
 * User: quand
 * Date: 7/17/2018
 * Time: 10:57 AM
 */

namespace App\Services\Api\Productions\Admin;


use App\Models\Department;
use App\Services\Api\Interfaces\ManageInterface;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Facades\Excel;

class DepartmentService extends BaseService implements ManageInterface
{
    public function __construct()
    {
        $this->model = new Department();
    }
    public function getAll($inputs)
    {
        if(isset($inputs['size']))
        {
            if($inputs['size'] == -1)
            {
                $departments =  Department::paginate(100000);
            }
           else{
               $departments = Department::paginate($inputs['size']);
           }
            foreach ($departments as $department)
            {
                $department->branches = $department->branches;
            }
            return $departments;
        }
        $departments = Department::paginate(500);
        foreach ($departments as $department)
        {
            $department->branches = $department->branches;
        }
        return $departments;

    }

    public function getOne($id)
    {
        $department = Department::findOrFail($id);
        $department->branches = $department->branches;
        return $department;
    }

    public function getProfile($option)
    {
        return Department::select($option)->get();
    }

    public function save($inputs)
    {
        $department = Department::create($inputs->all());
        return $department;
    }

    public function update($inputs, $id)
    {
        $columns = Schema::getColumnListing((new Department())->getTable());
        $department = Department::findOrFail($id);

        foreach ($columns as $column)
        {

            if(array_key_exists($column,$inputs))
            {
                if($column == $department->getKeyName())
                {
                    $branches =  $department->branches;
                    foreach ($branches as $branch)
                    {
                        $branch->department_code = $inputs[$column];
                        $branch->update();
                    }
                }
                $department->$column = $inputs[$column];
            }

        }
        $department->update();
        return $department;
    }

    public function destroy($id)
    {
        $department = Department::findOrFail($id);
        $department->branches()->delete();
        $department->delete();
        return $department;

    }

    public function delete($array)
    {
        $success = $array;
        foreach ($array as $item)
        {
            $department = Department::find($item);
            if($department)
            {
                $department->branches()->delete();
                $department->delete();
                unset($success[$item]);
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
                    Department::create($item);
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
            ],422);
        }
        return [
            'message' => 'Thành công',
            'error' => $list_err
        ];
    }
}