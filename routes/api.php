<?php
Route::group(['middleware' => ['auth:api']],function (){
    Route::group(["prefix" => '/admin','namespace' =>'Admin','as' => 'admin.','middleware' => ['api.check.admin']],function (){
        Route::group(['prefix' => '/manage-users', 'as' => 'manage.users.'],function (){
            Route::resource('/resource','UserManageController')->except(['create','edit']);
            Route::delete('delete-list','UserManageController@delete')->name('delete.list');
            Route::get('resource/{id}/enterprise','UserManageController@getEnterprise')->name('enterprise');
            Route::get('resource/{id}/student','UserManageController@getStudent')->name('student');
            Route::get('resource/{id}/admin','UserManageController@getAdmin')->name('admin');
            Route::post('/import-csv','UserManageController@importCsv')->name('import.csv');
            Route::post('/get-options-csv','UserManageController@getOptionsCsv')->name('get.option.csv');

        });
        Route::group(['prefix' => '/manage-students', 'as' => 'manage.students.'],function (){
            Route::resource('/resource','StudentManageController')->except(['create','edit']);
            Route::get('/resource/{code}/user','StudentManageController@getUser');
            Route::delete('delete-list','StudentManageController@delete')->name('delete.list');
            Route::post('update-avatar/{id}','StudentManageController@updateAvatar')->name('update.avatar');
            Route::get('list-enterprise/{id}','StudentManageController@listenterprise')->name('list.enterprise');
            Route::post('/import-csv','StudentManageController@importCsv')->name('import.csv');
            Route::get('list-work/{id}','StudentManageController@listWork')->name('list.work');
            Route::post('/get-options-csv','StudentManageController@getOptionsCsv')->name('get.option.csv');

        });
        Route::group(['prefix' => '/manage-enterprises' , 'name' => 'manage.enterprises.'],function (){
            Route::resource('/resource','EnterpriseManageController')->except(['create','edit']);
            Route::get('/resource/{id}/user','EnterpriseManageController@getUser');
            Route::delete('delete-list','EnterpriseManageController@delete')->name('delete.list');
            Route::post('update-avatar/{id}','EnterpriseManageController@updateAvatar')->name('update.avatar');
            Route::get('list-work/{id}','EnterpriseManageController@listWork')->name('list.work');
            Route::post('/import-csv','EnterpriseManageController@importCsv')->name('import.csv');
            Route::get('list-job/{id}','EnterpriseManageController@listJob')->name('list.job');
            Route::post('/get-options-csv','EnterpriseManageController@getOptionsCsv')->name('get.option.csv');
        });
        Route::group(['prefix' => '/manage-jobs',],function (){
            Route::resource('/resource','JobManageController')->except(['create','edit','store']);
            Route::delete('delete-list','JobManageController@delete')->name('delete.list');
            Route::post('/get-options-csv','JobManageController@getOptionsCsv')->name('get.option.csv');
            Route::post('/update-file-attach/{id}','JobManageController@updateFileAttach')->name('update.file.attach');
        });
        Route::group(['prefix' => '/manage-works'],function (){
            Route::resource('/resource','WorkManageController')->except(['create','edit']);
            Route::delete('delete-list','WorkManageController@delete')->name('delete.list');
            Route::post('/import-csv','WorkManageController@importCsv')->name('import.csv');
            Route::post('/get-options-csv','WorkManageController@getOptionsCsv')->name('get.option.csv');
        });
        Route::group(['prefix' => '/manage-ranks'],function (){
            Route::resource('/resource','RankManageController')->except(['create','edit']);
            Route::delete('delete-list','RankManageController@delete')->name('delete.list');
            Route::post('/import-csv','RankManageController@importCsv')->name('import.csv');
            Route::post('/get-options-csv','RankManageController@getOptionsCsv')->name('get.option.csv');
        });
        Route::group(['prefix' => '/manage-ratings'],function (){
            Route::resource('/resource','RatingManageController')->except(['create','edit']);
            Route::delete('delete-list','RatingManageController@delete')->name('delete.list');
            Route::post('/import-csv','RatingManageController@importCsv')->name('import.csv');
            Route::post('/get-options-csv','RatingManageController@getOptionsCsv')->name('get.option.csv');
        });
        Route::group(['prefix' => '/manage-departments'],function (){
            Route::resource('/resource','DepartmentManageController')->except(['create','edit']);
            Route::delete('delete-list','DepartmentManageController@delete')->name('delete.list');
            Route::post('/import-csv','DepartmentManageController@importCsv')->name('import.csv');
            Route::post('/get-options-csv','DepartmentManageController@getOptionsCsv')->name('get.option.csv');
        });
        Route::group(['prefix' => '/manage-branches'],function (){
            Route::resource('/resource','BranchManageController')->except(['create','edit']);
            Route::delete('delete-list','BranchManageController@delete')->name('delete.list');
            Route::post('/import-csv','BranchManageController@importCsv')->name('import.csv');
            Route::post('/get-options-csv','BranchManageController@getOptionsCsv')->name('get.option.csv');
        });
        Route::group(['prefix' => '/manage-courses'],function (){
            Route::resource('/resource','CourseManageController')->except(['create','edit']);
            Route::delete('delete-list','CourseManageController@delete')->name('delete.list');
            Route::post('/import-csv','CourseManageController@importCsv')->name('import.csv');
            Route::post('/get-options-csv','CourseManageController@getOptionsCsv')->name('get.option.csv');
        });
        Route::group(['prefix' => '/manage-notifies' , 'name' => 'manage.notifies.'],function (){
            Route::resource('/resource','NotificationManageController')->except(['create','edit']);
            Route::delete('delete-list','NotificationManageController@delete')->name('delete.list');
            Route::post('/get-options-csv','NotificationManageController@getOptionsCsv')->name('get.option.csv');
        });
        Route::group(['prefix' => '/manage-positions'],function (){
            Route::resource('/resource','PositionManageController')->except(['create','edit']);
            Route::delete('delete-list','PositionManageController@delete')->name('delete.list');
            Route::post('/import-csv','PositionManageController@importCsv')->name('import.csv');
            Route::post('/get-options-csv','PositionManageController@getOptionsCsv')->name('get.option.csv');
        });
        Route::group(['prefix' => '/manage-skills'],function (){
            Route::resource('/resource','SkillManageController')->except(['create','edit']);
            Route::delete('delete-list','SkillManageController@delete')->name('delete.list');
            Route::post('/import-csv','SkillManageController@importCsv')->name('import.csv');
            Route::post('/get-options-csv','SkillManageController@getOptionsCsv')->name('get.option.csv');
        });
        Route::group(['prefix' => '/manage-types'],function (){
            Route::resource('/resource','TypeManageController')->except(['create','edit']);
            Route::delete('delete-list','TypeManageController@delete')->name('delete.list');
            Route::post('/import-csv','TypeManageController@importCsv')->name('import.csv');
            Route::post('/get-options-csv','TypeManageController@getOptionsCsv')->name('get.option.csv');
        });
        Route::group(['prefix' => '/manage-salaries',],function (){
            Route::resource('/resource','SalaryManageController')->except(['create','edit']);
            Route::delete('delete-list','SalaryManageController@delete')->name('delete.list');
            Route::post('/import-csv','SalaryManageController@importCsv')->name('import.csv');
            Route::post('/get-options-csv','SalaryManageController@getOptionsCsv')->name('get.option.csv');
        });
        Route::group(['prefix' => '/manage-provinces'],function (){
            Route::resource('/resource','ProvinceManageController')->except(['create','edit']);
            Route::delete('delete-list','ProvinceManageController@delete')->name('delete.list');
            Route::post('/import-csv','ProvinceManageController@importCsv')->name('import.csv');
            Route::post('/get-options-csv','ProvinceManageController@getOptionsCsv')->name('get.option.csv');
        });
    });
    Route::group(['prefix' => '/enterprise','namespace' => 'Enterprise','as' => 'enterprise.','middleware' => ['api.check.enterprise']],function (){
        Route::group(['prefix' => '/manage-jobs',],function (){
            Route::resource('/resource','JobManageController')->except(['create','edit']);
            Route::delete('delete-list','JobManageController@delete')->name('delete.list');
            Route::post('/get-options-csv','JobManageController@getOptionsCsv')->name('get.option.csv');
            Route::post('/update-file-attach/{id}','JobManageController@updateFileAttach')->name('update.file.attach');

        });
        Route::get('profile','ProfileManageController@getProfile')->name('profile');
        Route::put('profile','ProfileManageController@updateProfile')->name('update.profile');
        Route::post('profile/update-avatar','ProfileManageController@updateAvatar')->name('update.avatar');
    });
    Route::group(['prefix' => '/student','namespace' => 'Student','as' => 'student.'],function (){
        Route::group(['prefix' => '/manage-work',],function (){
            Route::resource('/resource','WorkManageController')->only(['index']);
        });
        Route::get('profile','ProfileManageController@getProfile')->name('profile');
        Route::put('profile','ProfileManageController@updateProfile')->name('update.profile');
        Route::post('profile/update-avatar','ProfileManageController@updateAvatar')->name('update.avatar');
    });
    Route::group(['namespace' => 'Job'],function (){
        Route::resource('/jobs','JobController')->only(['index','show']);
    });

    Route::get('notifies','NotifyController@index');
    Route::get('positions','PositionController@index');
    Route::get('skills','SkillController@index');
    Route::get('types','TypeController@index');
    Route::get('salaries','SalaryController@index');
    Route::get('provinces','Provincetroller@index');
});

Route::group(['namespace' => 'Auth'],function (){
    Route::post('login','AuthController@login');
    Route::post('logout','AuthController@logout')->middleware('auth:api');
    Route::post('get-token','AuthController@getToken');
    Route::put('reset-password','AuthController@resetPassword');
});
Route::group(['prefix' => '/registration'],function(){
    Route::post('student','Student\AuthController@registration');
    Route::post('enterprise','Enterprise\AuthController@registration');
});
