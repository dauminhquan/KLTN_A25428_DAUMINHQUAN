<?php

Route::resource('/enterprises','EnterpriseManageController')->only('index','create','edit');
Route::resource('/students','StudentManageController')->only('index','create','edit');
Route::resource('/jobs','JobManageController')->only('index','edit');
Route::resource('/positions','PositionManageController')->only('index','create','edit');
Route::resource('/skills','SkillManageController')->only('index','create','edit');
Route::resource('/types','TypeManageController')->only('index','create','edit');
Route::resource('/works','WorkManageController')->only('index','create','edit');
Route::get('/','IndexController@index')->name('dashboard');