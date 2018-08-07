<?php
Route::group(['middleware' => 'web.check.auth'],function(){
    Route::get('/',['uses' => 'HomeController@index','as' => 'home'])->middleware(['web.check.auth']);
    Route::group(['as' => 'tasks.'],function(){
        Route::get('/tasks',['uses' => 'TaskController@index'])->name('index');
        Route::get('/tasks/{id}',['uses' => 'TaskController@info'])->name('info');
    });
    Route::group(['as' => 'notifies.'],function(){
        Route::get('/notifies',['uses' => 'NotifyController@index'])->name('index');
        Route::get('/notifies/{id}',['uses' => 'NotifyController@info'])->name('info');
    });

    Route::group(['as' => 'events.'],function(){

        Route::get('/events',['uses' => 'EventController@index'])->name('index');
        Route::get('/events/{id}',['uses' => 'EventController@info'])->name('info');
    });


});

Route::group(['namespace' => 'Auth'],function(){
    Route::get('login',['uses' => 'AuthController@login','as' => 'login']);
});


