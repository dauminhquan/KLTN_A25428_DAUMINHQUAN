<?php

Route::get('/',['uses' => 'HomeController@index','as' => 'home']);

Route::group(['namespace' => 'Auth'],function(){
   Route::get('login',['uses' => 'AuthController@login','as' => 'login']);
});

