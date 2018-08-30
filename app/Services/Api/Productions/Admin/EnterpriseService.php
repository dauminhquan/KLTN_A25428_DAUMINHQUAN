<?php
/**
 * Created by PhpStorm.
 * User: quand
 * Date: 7/16/2018
 * Time: 1:37 PM
 */

namespace App\Services\Api\Productions\Admin;

use App\Http\Requests\GetDataRequest;
use App\Models\Enterprise;
use App\Services\Api\Interfaces\ManageInterface;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class EnterpriseService extends BaseService implements ManageInterface
{

    public function __construct()
    {
        $this->model = new Enterprise();
    }

    public function getAll($inputs)
    {
        if(isset($inputs['size']))
        {
            if($inputs['size'] == -1)
            {
                return Enterprise::paginate(10000);
            }
            return Enterprise::paginate($inputs['size']);
        }
        return Enterprise::paginate(500);
    }

    public function getOne($id)
    {
        return Enterprise::findOrFail($id);
    }

    public function getProfile($option)
    {
        return Enterprise::select($option);
    }

    public function save($inputs){
        try{
            $enterprise = Enterprise::create($inputs);
            return $enterprise;
        }catch (\Exception $exception)
        {
            return ['err' => $exception->getMessage()];
        }
    }

    public function update($inputs,$id)
    {

            try{
                $columns = Schema::getColumnListing((new Enterprise())->getTable());
                $enterprise = Enterprise::findOrFail($id);
                foreach ($columns as $column)
                {
                    if(array_key_exists($column,$inputs))
                    {
                        $enterprise->$column = $inputs[$column];
                    }
                }
                $enterprise->update();
                return $enterprise;
            }catch (\Exception $exception)
            {
                return ['err' => $exception->getMessage()];
            }
    }
    public function destroy($id)
    {
        $enterprise = Enterprise::findOrFail($id);
        if(Storage::exists($enterprise->avatar) && $enterprise->avatar != env('AVATAR_DEFAULT'))
        {
            Storage::delete($enterprise->avatar);
        }

        $enterprise->user()->delete();
        $enterprise->tasks()->delete();
        $enterprise->delete();
        return $enterprise;
    }

    public function delete($array)
    {
        $success = $array;
        foreach ($array as $key => $item)
        {
            $enterprise = Enterprise::find($item);
            if($enterprise)
            {
                if(Storage::exists($enterprise->avatar) && $enterprise->avatar != env('AVATAR_DEFAULT')) {
                    Storage::delete($enterprise->avatar);
                }

                $enterprise->user()->delete();
                $enterprise->tasks()->delete();
                $enterprise->delete();
                unset($success[$key]);
            }
        }
        return $success;
    }

    public function csvStore($path){
        $data = Excel::load($path,function($reader){})->get()->toArray();
        $countSuccess = 0;
        $listNameError = [];
        $importError = [];
        if(count($data) > 0)
        {
            foreach ($data as $index => $item)
            {

                try{
                    $enterprise = Enterprise::where('name',$item['name'])->orWhere('email_address',$item['email_address'])->first();
                    if(!$enterprise)
                    {
                        Enterprise::create($item);
                        $countSuccess++;
                    }
                    else{
                        $listNameError[] = [
                            'name' => $item['name'],
                            'index' => $index+2
                        ];
                    }
                }catch (\Exception $exception)
                {
                    $importError[] = [
                      'index' => $index+2,
                      'message' => 'Lỗi nghiêm trọng'
                    ];
                }
            }
        }
        if((count($listNameError) + count($importError)) == count($data))
        {
            return response()->json([
                'message' => "File rỗng | Sai định dạng | Trùng dữ liệu toàn bộ",
                'error' => $listNameError
            ],406);
        }
        return [
            'message' => 'Thêm danh sách doanh nghiệp thành công',
            'error' => $listNameError,
            'success' => $countSuccess,
            'importError' => $importError
        ];
    }

    public function updateAvatar($id,$avatar){
        $enterprise = Enterprise::findOrFail($id);
        if(Storage::exists($enterprise->avatar) && $enterprise->avatar != env('AVATAR_DEFAULT'))
        {
            Storage::delete($enterprise->avatar);

        }
        $url = Storage::url($avatar->store('/public/avatar'));
        $enterprise->avatar = $url;
        $enterprise->update();
        return [
            'url' => $url
        ];
    }
    public function getListWork($id)
    {
        $enterprise = Enterprise::findOrFail($id);

        $works = $enterprise->works;

        foreach ($works as $work)
        {
            $work->student = $work->student()->select('code','full_name','avatar')->first();
            $work->salary = $work->salary()->first();
            $work->rank = $work->rank()->first();
        }
        return $works;
    }
    public function getListTask($inputs,$id){
        $enterprise = Enterprise::findOrFail($id);
        if(isset($inputs['size']))
        {
            if('size' == -1)
            {
                $tasks = $enterprise->tasks;
            }
            else{
                $tasks = $enterprise->tasks()->paginate($inputs['size']);
            }
        }
        foreach ($tasks as $task)
        {

            $task->salary = $task->salary;
            $task->rank = $task->rank;
        }
        return $tasks;
    }
    public function getUser($id)
    {
        $enterprise = Enterprise::findOrFail($id);
        return $enterprise->user;
    }
}
