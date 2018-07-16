<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
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
        return $this->hasOne(Admin::class,'id_user','id');
    }

}
