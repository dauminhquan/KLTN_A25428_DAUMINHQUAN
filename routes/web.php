<?php
Route::group(['middleware' => 'web.check.auth'],function(){
    Route::get('/',['uses' => 'HomeController@index','as' => 'home'])->middleware(['web.check.auth']);
    Route::get('/tasks',['uses' => 'TaskController@index']);
    Route::get('/tasks/{id}',['uses' => 'TaskController@info']);
    Route::get('/notifies',['uses' => 'NotifyController@index']);
    Route::get('/notifies/{id}',['uses' => 'NotifyController@info']);
});

Route::group(['namespace' => 'Auth'],function(){
    Route::get('login',['uses' => 'AuthController@login','as' => 'login']);
});


