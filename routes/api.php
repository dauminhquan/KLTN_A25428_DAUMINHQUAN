<?php

Route::group(["prefix" => '/admin','namespace' =>'Admin' ],function (){

    Route::group(['prefix' => '/manage-students'],function (){
        Route::resource('/resource','StudentManageController')->except(['create','edit']);
        Route::delete('delete-list','StudentManageController@delete');
        Route::post('update-avatar/{id}','StudentManageController@updateAvatar');
        Route::get('list-enterprise/{id}','StudentManageController@listenterprise');
        Route::post('/import-csv','StudentManageController@importCsv');
        Route::get('list-job/{id}','StudentManageController@listJob');


    });
    Route::group(['prefix' => '/manage-enterprises'],function (){
        Route::resource('/resource','EnterpriseManageController')->except(['create','edit']);
        Route::delete('delete-list','EnterpriseManageController@delete');
        Route::post('update-avatar/{id}','EnterpriseManageController@updateAvatar');
        Route::get('list-student/{id}','EnterpriseManageController@listStudent');
        Route::post('/import-csv','EnterpriseManageController@importCsv');
        Route::get('list-job/{id}','EnterpriseManageController@listJob');
    });
    Route::group(['prefix' => '/manage-jobs',],function (){
        Route::resource('/resource','JobManageController')->except(['create','edit','store']);
        Route::delete('delete-list','JobManageController@delete');
    });
    Route::group(['prefix' => '/manage-positions'],function (){
        Route::resource('/resource','PositionManageController')->except(['create','edit']);
        Route::delete('delete-list','PositionManageController@delete');
        Route::post('/import-csv','PositionManageController@importCsv');
    });
    Route::group(['prefix' => '/manage-skills'],function (){
        Route::resource('/resource','SkillManageController')->except(['create','edit']);
        Route::delete('delete-list','SkillManageController@delete');
        Route::post('/import-csv','SkillManageController@importCsv');
    });
    Route::group(['prefix' => '/manage-types'],function (){
        Route::resource('/resource','TypeManageController')->except(['create','edit']);
        Route::delete('delete-list','TypeManageController@delete');
        Route::post('/import-csv','TypeManageController@importCsv');
    });
    Route::group(['prefix' => '/manage-works'],function (){
        Route::resource('/resource','WorkManageController')->except(['create','edit']);
        Route::delete('delete-list','WorkManageController@delete');
        Route::post('/import-csv','WorkManageController@importCsv');
    });
});
Route::group(['prefix' => '/enterprise','namespace' => 'Enterprise'],function (){
    Route::group(['prefix' => '/manage-jobs',],function (){
        Route::resource('/resource','JobManageController')->except(['create','edit']);
        Route::delete('delete-list','JobManageController@delete');

    });
    Route::get('profile','ProfileManageController@getProfile');
    Route::put('profile','ProfileManageController@updateProfile');
    Route::post('profile/update-avatar','ProfileController@updateAvatar');
});
Route::group(['namespace' => 'Job'],function (){
    Route::resource('/jobs','JobManageController')->only(['index','show']);
});
