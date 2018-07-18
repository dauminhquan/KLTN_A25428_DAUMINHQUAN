<?php
/**
 * Created by PhpStorm.
 * User: quand
 * Date: 7/17/2018
 * Time: 10:57 AM
 */

namespace App\Services\Api\Productions\Admin;


use App\Models\Skill;
use App\Services\Api\Interfaces\ManageInterface;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Facades\Excel;

class SkillService implements ManageInterface
{
    public function getAll()
    {
        $skills = Skill::all();
        return $skills;
    }

    public function getOne($id)
    {
        $skill = Skill::findOrFail($id);
        return $skill;
    }

    public function getProfile($option)
    {
        return Skill::select($option)->get();
    }

    public function save($inputs)
    {
        $skill = Skill::create($inputs->all());

        return $skill;
    }

    public function update($inputs, $id)
    {
        try{
            $columns = Schema::getColumnListing((new Skill())->getTableName());
            $skill = Skill::findOrFail($id);
            foreach ($columns as $column)
            {
                if(isset($inputs[$column]))
                {
                    $skill->$column = $inputs[$column];
                }

            }
            $skill->update();
            return $skill;
        }catch (\Exception $exception)
        {
            return ['err' => $exception->getMessage()];
        }
    }

    public function destroy($id)
    {
        $skill = Skill::findOrFail($id);
        $skill->delete();
        return $skill;

    }

    public function delete($array)
    {
        $success = $array;
        foreach ($array as $key => $item)
        {
            $skill = Skill::find($item);
            if($skill)
            {
                $skill->delete();
                unset($success[$key]);
            }
        }
        return $success;
    }

    public function csvStore($path){
        $list_err = [];

        $data = Excel::load($path,function($reader){})->get()->toArray();
        if(count($data) > 0)
        {
            foreach ($data as $item)
            {

                try{
                    Skill::create($item);
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