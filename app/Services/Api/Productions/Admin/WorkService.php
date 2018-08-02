<?php
/**
 * Created by PhpStorm.
 * User: quand
 * Date: 7/17/2018
 * Time: 5:20 PM
 */

namespace App\Services\Api\Productions\Admin;


use App\Models\Work;
use App\Services\Api\Interfaces\ManageInterface;
use Illuminate\Support\Facades\Schema;

class WorkService extends BaseService implements ManageInterface
{
    public function __construct()
    {
        $this->model = new Work();
    }
    public function getAll($inputs)
    {
        $works = Work::all();
        foreach ($works as $work)
        {
            // tra ve ten doanh nghiep + avatar
            $work->enterprise = $work->enterprise;
            $work->student = $work->student;
            $work->salary = $work->salary;
        }
        return $works;
    }

    public function getOne($id)
    {
        $work = Work::findOrFail($id);
        $work->enterprise = $work->enterprise;
        $work->student = $work->student;
        $work->salary = $work->salary;
        $work->rank = $work->rank;
        return $work;
    }

    public function getProfile($option)
    {
        return Work::select($option)->get();
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
                if(isset($inputs[$column]))
                {
                    $work->$column = $inputs[$column];
                }

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
        $success = $array;
        foreach ($array as $item)
        {

            $work = Work::find($item);
            if($work)
            {
                $work->delete();
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