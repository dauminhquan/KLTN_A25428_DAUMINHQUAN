<?php

namespace App\Models;



use App\Model;

class Province extends Model
{
    protected $table = 'provinces';
    protected $fillable = ['name','id'];
}
