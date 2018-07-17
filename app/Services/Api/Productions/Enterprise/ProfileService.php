<?php
/**
 * Created by PhpStorm.
 * User: quand
 * Date: 7/16/2018
 * Time: 5:04 PM
 */

namespace App\Services\Api\Productions\Enterprise;



use App\Models\Enterprise;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class ProfileService
{
    private $enterprise;
    public function __construct()
    {
        $this->enterprise = Enterprise::findOrFail(Auth::user()->enterprise);
    }

    public function profile()
    {
        return $this->enterprise;
    }

    public function updateProfile($inputs)
    {
        try{

            $columns = Schema::getColumnListing((new Enterprise())->getTableName());
            foreach ($columns as $column)
            {
                if(isset($inputs[$column]))
                {
                    $this->enterprise->$column = $inputs[$column];
                }
            }
            $this->enterprise->save();
            return $this->enterprise;

        }catch (\Exception $exception)
        {
            return ['err' => $exception->getMessage()];
        }
    }
    public function updateAvatar($avatar){
        if(Storage::exists($this->enterprise->avatar))
        {
            Storage::delete($this->enterprise->avatar);
        }
        $url = $avatar->store('/public/avatar');
        $this->enterprise->avatar = $url;
        $this->enterprise->update();
        return [
            'url' => $url
        ];
    }

}