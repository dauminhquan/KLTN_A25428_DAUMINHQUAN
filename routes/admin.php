<?php

Route::resource('/enterprises','EnterpriseManageController')->only('index','create','edit');
Route::resource('/students','StudentManageController')->only('index','create','edit');
Route::resource('/jobs','JobManageController')->only('index','edit');
Route::resource('/positions','PositionManageController')->only('index');
Route::resource('/skills','SkillManageController')->only('index');
Route::resource('/types','TypeManageController')->only('index');
Route::resource('/salaries','SalaryManageController')->only('index');
Route::resource('/works','WorkManageController')->only('index','create','edit');
Route::get('/','IndexController@index')->name('dashboard');