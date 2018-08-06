<?php

namespace App\Models;

use App\Model;

class Task extends Model
{
    //
    protected $table = 'tasks';

    protected $fillable = ['enterprise_id','title','location','time_start','time_end','description','attachment','content','salary_id'];

    public function enterprise(){
        return $this->belongsTo(Enterprise::class,'enterprise_id','id');
    }

    public function types(){
        return $this->belongsToMany(Type::class,'task_type');
    }
    public function skills(){
        return $this->belongsToMany(Skill::class,'task_skill');

    }
    public function positions(){
        return $this->belongsToMany(Position::class,'task_position');
    }
    public function salary(){
        return $this->belongsTo(Salary::class);
    }
}
