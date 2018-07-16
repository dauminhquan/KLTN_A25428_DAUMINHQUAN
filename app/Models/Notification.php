<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';
    public function admin(){
        return $this->hasOne(Admin::class,'id','admin_id');
    }
}
