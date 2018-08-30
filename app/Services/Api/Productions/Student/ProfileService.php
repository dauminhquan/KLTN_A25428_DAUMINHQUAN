<?php
/**
 * Created by PhpStorm.
 * User: quand
 * Date: 7/16/2018
 * Time: 5:04 PM
 */

namespace App\Services\Api\Productions\Student;



use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class ProfileService
{
    private $student;
    public function __construct()
    {

    }

    public function profile()
    {

        $this->student = session('user')->student;
        $this->student->province = $this->student->province;
        return $this->student;
    }

    public function updateProfile($inputs)
    {
        $this->student = session('user');
        $this->student = Student::find($this->student->student->code);
        unset($inputs['code']);
        unset($inputs['rating_id']);
        unset($inputs['sex']);
        unset($inputs['user_id']);
        unset($inputs['graduated']);
        unset($inputs['medium_score']);
        unset($inputs['date_graduated']);
        unset($inputs['course_code']);
        unset($inputs['branch_code']);
        unset($inputs['main_class']);
        try{

            $columns = Schema::getColumnListing((new Student())->getTable());

            foreach ($columns as $column)
            {
                if(array_key_exists($column,$inputs))
                {
                    $this->student->$column = $inputs[$column];
                }
            }
            $this->student->update();
            return $this->student;

        }catch (\Exception $exception)
        {
            return ['err' => $exception->getMessage()];
        }
    }
    public function updateAvatar($avatar){
        $this->student = session('user')->student;
        if(Storage::exists($this->student->avatar))
        {
            Storage::delete($this->student->avatar);
        }
        $url = $avatar->store('/public/avatar');
        $this->student->avatar = $url;
        $this->student->update();
        return [
            'url' => $url
        ];
    }

}