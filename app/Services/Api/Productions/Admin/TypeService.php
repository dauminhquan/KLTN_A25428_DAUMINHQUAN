<?php
/**
 * Created by PhpStorm.
 * User: quand
 * Date: 7/17/2018
 * Time: 10:57 AM
 */

namespace App\Services\Api\Productions\Admin;


use App\Models\Type;
use App\Services\Api\Interfaces\ManageInterface;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Facades\Excel;

class TypeService extends BaseService implements ManageInterface
{
    public function __construct()
    {
        $this->model = new Type();
    }
    public function getAll()
    {
        $types = Type::all();
        return $types;
    }

    public function getOne($id)
    {
        $type = Type::findOrFail($id);
        return $type;
    }

    public function getProfile($option)
    {
        return Type::select($option)->get();
    }

    public function save($inputs)
    {
        $type = Type::create($inputs->all());

        return $type;
    }

    public function update($inputs, $id)
    {
        try{
            $columns = Schema::getColumnListing((new Type())->getTableName());
            $type = Type::findOrFail($id);
            foreach ($columns as $column)
            {
                if(isset($inputs[$column]))
                {
                    $type->$column = $inputs[$column];
                }

            }
            $type->update();
            return $type;
        }catch (\Exception $exception)
        {
            return ['err' => $exception->getMessage()];
        }
    }

    public function destroy($id)
    {
        $type = Type::findOrFail($id);
        $type->delete();
        return $type;

    }

    public function delete($array)
    {
        $success = $array;
        foreach ($array as $item)
        {
            $type = Type::find($item);
            if($type)
            {
                $type->delete();
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
                    Type::create($item);
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