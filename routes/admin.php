<?php

Route::resource('/enterprises','EnterpriseManageController')->only('index','create','edit');
Route::resource('/students','StudentManageController')->only('index','create','edit');
Route::resource('/notifies','NotificationManageController')->only('index','create','edit');
Route::resource('/tasks','TaskManageController')->only('index','edit');
Route::resource('/positions','PositionManageController')->only('index');
Route::resource('/users','UserController')->only('index');
Route::resource('/skills','SkillManageController')->only('index');
Route::resource('/types','TypeManageController')->only('index');
Route::resource('/ranks','RankManageController')->only('index');
Route::resource('/departments','DepartmentManageController')->only('index');
Route::resource('/courses','CourseManageController')->only('index');
Route::resource('/branches','BranchManageController')->only('index');
Route::resource('/ratings','RatingManageController')->only('index');
Route::resource('/admins','AdminManageController')->only('index');
Route::resource('/salaries','SalaryManageController')->only('index');
Route::resource('/provinces','ProvinceManageController')->only('index');
Route::resource('/works','WorkManageController')->only('index','create','edit');
Route::resource('/events','EventManageController')->only('index','create','edit');
Route::resource('/statistical','StatisticalManageController')->only('index');
Route::group(['prefix' => 'get-sample-csv-file','as' => 'ge.sample.csv.file'],function(){
    Route::get('/user',['as' => 'user','uses' => 'GetSampleFileExcelController@user']);
    Route::get('/enterprise',['as' => 'enterprise','uses' => 'GetSampleFileExcelController@enterprise']);
    Route::get('/work',['as' => 'work','uses' => 'GetSampleFileExcelController@work']);
    Route::get('/course',['as' => 'course','uses' => 'GetSampleFileExcelController@course']);
    Route::get('/department',['as' => 'department','uses' => 'GetSampleFileExcelController@department']);
    Route::get('/branch',['as' => 'branch','uses' => 'GetSampleFileExcelController@branch']);
    Route::get('/province',['as' => 'province','uses' => 'GetSampleFileExcelController@province']);
    Route::get('/student',['as' => 'student','uses' => 'GetSampleFileExcelController@student']);
    Route::get('/event-student',['as' => 'student','uses' => 'GetSampleFileExcelController@eventStudent']);
});
Route::get('/cover-data','CoverDataController@coverData')->name('cover.data');
Route::post('/cover-data','CoverDataController@postCoverData');
Route::get('/import-data','CoverDataController@importData')->name('import.data');
Route::post('/import-data','CoverDataController@postImportData');
Route::get('/export-data','CoverDataController@exportData')->name('export.data');
Route::get('/','IndexController@index')->name('dashboard');
