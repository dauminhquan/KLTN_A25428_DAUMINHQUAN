<?php
/**
 * Created by PhpStorm.
 * User: quand
 * Date: 7/17/2018
 * Time: 10:57 AM
 */

namespace App\Services\Api\Productions\Admin;


use App\Models\Position;
use App\Services\Api\Interfaces\ManageInterface;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Facades\Excel;

class PositionService implements ManageInterface
{
    public function getAll()
    {
        $positions = Position::all();
        return $positions;
    }

    public function getOne($id)
    {
        $position = Position::findOrFail($id);
        return $position;
    }

    public function getProfile($option)
    {
        return Position::select($option)->get();
    }

    public function save($inputs)
    {
        $position = Position::create($inputs->all());

        return $position;
    }

    public function update($inputs, $id)
    {
        try{
            $columns = Schema::getColumnListing((new Position())->getTableName());
            $position = Position::findOrFail($id);
            foreach ($columns as $column)
            {
                if(isset($inputs[$column]))
                {
                    $position->$column = $inputs[$column];
                }

            }
            $position->update();
            return $position;
        }catch (\Exception $exception)
        {
            return ['err' => $exception->getMessage()];
        }
    }

    public function destroy($id)
    {
        $position = Position::findOrFail($id);
        $position->delete();
        return $position;

    }

    public function delete($array)
    {
        $success = $array;

        foreach ($array as $key => $item)
        {
            $position = Position::find($item);
            if($position)
            {
                $position->delete();
                unset($success[$key]);
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
                    Position::create($item);
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