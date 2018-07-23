<?php

Route::resource('/jobs','JobManageController')->only('index','create','edit');
Route::get('/profile','ProfileManageController@index')->name('profile');
Route::get('/profile/update','ProfileManageController@update')->name('update.profile');