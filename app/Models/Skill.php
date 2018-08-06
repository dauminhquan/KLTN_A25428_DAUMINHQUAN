<?php

namespace App\Models;
use App\Model;

class Skill extends Model
{
    //
    protected $table = 'skills';
    protected $fillable = ['name'];
    public function tasks(){
        return $this->belongsToMany(Task::class,'task_skill');
    }
}
