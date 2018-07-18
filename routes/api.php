<?php

Route::group(["prefix" => '/admin','namespace' =>'Admin','as' => 'admin.'],function (){

    Route::group(['prefix' => '/manage-students', 'as' => 'manage.students.'],function (){
        Route::resource('/resource','StudentManageController')->except(['create','edit']);
        Route::delete('delete-list','StudentManageController@delete')->name('delete.list');
        Route::post('update-avatar/{id}','StudentManageController@updateAvatar')->name('update.avatar');
        Route::get('list-enterprise/{id}','StudentManageController@listenterprise')->name('list.enterprise');
        Route::post('/import-csv','StudentManageController@importCsv')->name('import.csv');
        Route::get('list-job/{id}','StudentManageController@listJob')->name('list.job');


    });
    Route::group(['prefix' => '/manage-enterprises' , 'name' => 'manage.enterprises.'],function (){
        Route::resource('/resource','EnterpriseManageController')->except(['create','edit']);
        Route::delete('delete-list','EnterpriseManageController@delete')->name('delete.list');
        Route::post('update-avatar/{id}','EnterpriseManageController@updateAvatar')->name('update.avatar');
        Route::get('list-student/{id}','EnterpriseManageController@listStudent')->name('list.student');
        Route::post('/import-csv','EnterpriseManageController@importCsv')->name('import.csv');
        Route::get('list-job/{id}','EnterpriseManageController@listJob')->name('list.job');
    });
    Route::group(['prefix' => '/manage-jobs',],function (){
        Route::resource('/resource','JobManageController')->except(['create','edit','store']);
        Route::delete('delete-list','JobManageController@delete')->name('delete.list');
    });
    Route::group(['prefix' => '/manage-positions'],function (){
        Route::resource('/resource','PositionManageController')->except(['create','edit']);
        Route::delete('delete-list','PositionManageController@delete')->name('delete.list');
        Route::post('/import-csv','PositionManageController@importCsv')->name('import.csv');
    });
    Route::group(['prefix' => '/manage-skills'],function (){
        Route::resource('/resource','SkillManageController')->except(['create','edit']);
        Route::delete('delete-list','SkillManageController@delete')->name('delete.list');
        Route::post('/import-csv','SkillManageController@importCsv')->name('import.csv');
    });
    Route::group(['prefix' => '/manage-types'],function (){
        Route::resource('/resource','TypeManageController')->except(['create','edit']);
        Route::delete('delete-list','TypeManageController@delete')->name('delete.list');
        Route::post('/import-csv','TypeManageController@importCsv')->name('import.csv');
    });
    Route::group(['prefix' => '/manage-works'],function (){
        Route::resource('/resource','WorkManageController')->except(['create','edit']);
        Route::delete('delete-list','WorkManageController@delete')->name('delete.list');
        Route::post('/import-csv','WorkManageController@importCsv')->name('import.csv');
    });
});
Route::group(['prefix' => '/enterprise','namespace' => 'Enterprise','as' => 'enterprise.'],function (){
    Route::group(['prefix' => '/manage-jobs',],function (){
        Route::resource('/resource','JobManageController')->except(['create','edit']);
        Route::delete('delete-list','JobManageController@delete')->name('delete.list');

    });
    Route::get('profile','ProfileManageController@getProfile')->name('profile');
    Route::put('profile','ProfileManageController@updateProfile')->name('update.profile');
    Route::post('profile/update-avatar','ProfileManageController@updateAvatar')->name('update.avatar');
});
Route::group(['prefix' => '/student','namespace' => 'Student','as' => 'student.'],function (){
   /* Route::group(['prefix' => '/manage-work',],function (){
        Route::resource('/resource','WorkManageController')->only(['index']);
    });*/
    Route::get('profile','ProfileManageController@getProfile')->name('profile');
    Route::put('profile','ProfileManageController@updateProfile')->name('update.profile');
    Route::post('profile/update-avatar','ProfileManageController@updateAvatar')->name('update.avatar');
});
Route::group(['namespace' => 'Job'],function (){
    Route::resource('/jobs','JobController')->only(['index','show']);
});

