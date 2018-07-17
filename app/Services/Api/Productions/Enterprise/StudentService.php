<?php
/**
 * Created by PhpStorm.
 * User: quand
 * Date: 7/16/2018
 * Time: 1:37 PM
 */

namespace App\Services\Api\Productions\Enterprise;


use App\Models\Student;
use App\Services\Api\Interfaces\ManageInterface;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class StudentService implements ManageInterface
{


    private $enterprise;
    public function __construct()
    {
        $this->enterprise = Enterprise::findOrFail(Auth::user()->enterprise);
    }

    public function getAll()
    {
        return $this->enterprise->students();
    }

    public function getOne($id)
    {
        abort_unless(false,404);
    }

    public function getProfile($option)
    {
        abort_unless(false,404);
    }

    public function save($inputs){
        abort_unless(false,404);
    }

    public function update($inputs,$id)
    {

        abort_unless(false,404);
    }

    public function destroy($id)
    {
        abort_unless(false,404);
    }

}