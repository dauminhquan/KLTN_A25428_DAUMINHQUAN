<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\Jobs\Job;

class Enterprise extends Model
{
    //
    protected $table = 'enterprises';
    protected $fillable = ['name','address','name_president','phone_number','email_address','introduce'];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function jobs(){
        return $this->hasMany(Job::class,'enterprise_id','id');
    }
    public function getTableName(){
        return $this->table;
    }

}
