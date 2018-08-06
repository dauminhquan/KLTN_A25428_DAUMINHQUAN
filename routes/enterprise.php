<?php

Route::resource('/tasks','TaskManageController')->only('index','create','edit');
Route::get('/profile','ProfileManageController@index')->name('profile');
Route::get('/profile/update','ProfileManageController@update')->name('update.profile');