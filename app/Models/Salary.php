<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $table='salaries';
    protected $hidden = ['created_at','updated_at'];
}
