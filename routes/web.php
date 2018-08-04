<?php

Route::get('/',['uses' => 'HomeController@index','as' => 'home'])->middleware(['web.check.auth']);

Route::group(['namespace' => 'Auth'],function(){
   Route::get('login',['uses' => 'AuthController@login','as' => 'login']);
});

