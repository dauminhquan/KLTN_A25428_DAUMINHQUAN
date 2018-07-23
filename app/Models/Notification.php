<?php

namespace App\Models;

use App\Model;

class Notification extends Model
{
    protected $table = 'notifications';
    public function admin(){
        return $this->hasOne(Admin::class,'id','admin_id');
    }
}
