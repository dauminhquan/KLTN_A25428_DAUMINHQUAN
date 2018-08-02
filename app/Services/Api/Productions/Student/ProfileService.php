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
        $this->student = Student::findOrFail(Auth::user()->student);
    }

    public function profile()
    {
        return $this->student;
    }

    public function updateProfile($inputs)
    {
        try{

            $columns = Schema::getColumnListing((new Student())->getTable());
            foreach ($columns as $column)
            {
                if(isset($inputs[$column]))
                {
                    $this->student->$column = $inputs[$column];
                }
            }
            $this->student->save();
            return $this->student;

        }catch (\Exception $exception)
        {
            return ['err' => $exception->getMessage()];
        }
    }
    public function updateAvatar($avatar){
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