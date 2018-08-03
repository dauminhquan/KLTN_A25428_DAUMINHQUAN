<?php

use Illuminate\Http\Request;


Route::get('/',['uses' => 'HomeController@index']);

Route::group(['namespace' => 'Auth'],function(){
   Route::get('login',['uses' => 'LoginController@login']);
});

