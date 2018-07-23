<?php
/**
 * Created by PhpStorm.
 * User: quand
 * Date: 7/17/2018
 * Time: 10:57 AM
 */

namespace App\Services\Api\Productions\Admin;


use App\Models\Course;
use App\Services\Api\Interfaces\ManageInterface;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Facades\Excel;

class CourseService extends BaseService implements ManageInterface
{
    public function __construct()
    {
        $this->model = new Course();
    }
    public function getAll()
    {
        $courses = Course::all();
        return $courses;
    }

    public function getOne($id)
    {
        $course = Course::findOrFail($id);
        return $course;
    }

    public function getProfile($option)
    {
        return Course::select($option)->get();
    }

    public function save($inputs)
    {
        $course = Course::create($inputs->all());

        return $course;
    }

    public function update($inputs, $id)
    {
        try{
            $columns = Schema::getColumnListing((new Course())->getTableName());
            $course = Course::findOrFail($id);
            foreach ($columns as $column)
            {
                if(isset($inputs[$column]))
                {
                    $course->$column = $inputs[$column];
                }

            }
            $course->update();
            return $course;
        }catch (\Exception $exception)
        {
            return ['err' => $exception->getMessage()];
        }
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();
        return $course;

    }

    public function delete($array)
    {
        $success = $array;
        foreach ($array as $item)
        {
            $course = Course::find($item);
            if($course)
            {
                $course->delete();
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
                    Course::create($item);
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