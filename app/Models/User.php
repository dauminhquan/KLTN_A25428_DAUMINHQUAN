<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Schema;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;


    protected $table = 'users';
    protected $fillable = [
        'password','email','type'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];


    public function student()
    {
        return $this->hasOne(Student::class,'user_id','id');
    }
    public function enterprise()
    {
        return $this->hasOne(Enterprise::class,'user_id','id');
    }
    public function token_api()
    {
        return $this->hasMany('App\Models\OauthAccessTokens','user_id','id');
    }

    public function admin()
    {
        return $this->hasOne(Admin::class,'user_id','id');
    }
    public function getOption($column,$queryValue,$selects)
    {

        $columns = Schema::getColumnListing(self::getTable());
        if(in_array($column,$columns))
        {

            return $this->select($selects)->where($column,'like',$queryValue)->first();
        }
        return null;
    }

    public function receivesBroadcastNotificationsOn()
    {
        return 'users.'.$this->id;
    }
}
