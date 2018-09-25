<?php

namespace App\Models;



use App\Model;

class Admin extends Model
{
    protected $table = 'admins';
    protected $fillable =['name'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
