<?php
/**
 * Created by PhpStorm.
 * User: quand
 * Date: 7/17/2018
 * Time: 10:57 AM
 */

namespace App\Services\Api\Productions\Admin;


use App\Models\Rating;
use App\Services\Api\Interfaces\ManageInterface;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Facades\Excel;

class RatingService extends BaseService implements ManageInterface
{
    public function __construct()
    {
        $this->model = new Rating();
    }
    public function getAll($inputs)
    {
        if(isset($inputs['size']))
        {
            if($inputs['size'] == -1)
            {
                return Rating::paginate(100000);
            }
            return Rating::paginate($inputs['size']);
        }
        return Rating::paginate(500);

    }

    public function getOne($id)
    {
        $rating = Rating::findOrFail($id);
        return $rating;
    }

    public function getProfile($option)
    {
        return Rating::select($option)->get();
    }

    public function save($inputs)
    {
        $rating = Rating::create($inputs->all());

        return $rating;
    }

    public function update($inputs, $id)
    {
        try{
            $columns = Schema::getColumnListing((new Rating())->getTableName());
            $rating = Rating::findOrFail($id);
            foreach ($columns as $column)
            {
                if(isset($inputs[$column]))
                {
                    $rating->$column = $inputs[$column];
                }

            }
            $rating->update();
            return $rating;
        }catch (\Exception $exception)
        {
            return ['err' => $exception->getMessage()];
        }
    }

    public function destroy($id)
    {
        $rating = Rating::findOrFail($id);
        $rating->delete();
        return $rating;

    }

    public function delete($array)
    {
        $success = $array;
        foreach ($array as $item)
        {
            $rating = Rating::find($item);
            if($rating)
            {
                $rating->delete();
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
                    Rating::create($item);
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