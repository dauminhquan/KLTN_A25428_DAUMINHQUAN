<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['namespace' => 'Api'],function(){


    Route::group(['name' => 'auth:api'],function (){
//        api.check.admin
        Route::group(["prefix" => '/admin','namespace' =>'Admin' ],function (){

            // quan ly sinh vien
            Route::group(['prefix' => '/manage-students'],function (){
                Route::resource('/resource','StudentManageController')->except(['create','edit']);
                Route::delete('delete-list','StudentManageController@delete');
                Route::post('update-avatar/{id}','StudentManageController@updateAvatar');
                Route::get('list-enterprise/{id}','StudentManageController@listenterprise');
                Route::post('/import-csv','StudentManageController@importCsv');
                Route::get('list-job/{id}','StudentManageController@listJob');


            });
            // quan ly doanh nghiẹp

            Route::group(['prefix' => '/manage-enterprises'],function (){
                Route::resource('/resource','EnterpriseManageController')->except(['create','edit']);
                Route::delete('delete-list','EnterpriseManageController@delete');
                Route::post('update-avatar/{id}','EnterpriseManageController@updateAvatar');
                Route::get('list-student/{id}','EnterpriseManageController@listStudent');
                Route::post('/import-csv','EnterpriseManageController@importCsv');
                Route::get('list-job/{id}','EnterpriseManageController@listJob');
            });

            //job
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

            /*
            //post course
            Route::group(['prefix' => '/post-course-manage','name' => 'post.course.manage.'],function (){

                Route::get('/get-list-post-course',['name' => 'get.list.post.course','uses' => 'PostCourseManageController@get_list_post_course']);
                Route::put('/accept-post-course/{id}',['name' => 'accept.post.course','uses'=> 'PostCourseManageController@accept_post_course']);
                Route::get('/get-detail-post-course/{id}',['name' => 'get.detail.post.course','uses' => 'PostCourseManageController@get_detail_post_course']);
            });

            Route::group(['prefix' => '/notify-manage','as' => 'notify.manage.'],function(){
                Route::get('/notifies',['as' => 'notifies','uses' => 'NotifyController@notifies']);
                Route::get('/notify/{id}',['as' => 'notify.id','uses' => 'NotifyController@notify']);
                Route::post('/notify/{id}',['as' => 'notify_id','uses' => 'NotifyController@update_notify']);
                Route::delete('/delete-notify/{id}',['as' => 'delete_notify','uses' => 'NotifyController@delete_notify']);
                Route::delete('/delete-list-notify',['as' => 'delete_list_notify','uses' => 'NotifyController@delete_list_notify']);
                Route::post('/add-notify',['as' => 'add_notify','uses' => 'NotifyController@add_notify']);
                Route::post('/update-notify/{id}',['as' => 'update_notify','uses' => 'NotifyController@update_notify']);
            });*/
            //post
//        Route::group(['prefix' => '/post-manage','name' => 'post.manage.'],function (){
//
//
//
//        });

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

       /* Route::group(['prefix' => '/request-info','name' => 'get.info.'],function (){
            Route::get('get-courses','RequestInfoController@get_courses');
            Route::get('get-departments','RequestInfoController@get_departments');
            Route::get('get-branches/{department}','RequestInfoController@get_branches_with_code_departments');
            Route::get('get-list-salary','RequestInfoController@get_list_salary');
            Route::group(['middleware' => 'api.check.admin'],function(){
                Route::post('check-exist-info-student','RequestInfoController@check_exist_info_student');
                Route::get('get-option-student','RequestInfoController@get_option_student');
                Route::get('get-info-student','RequestInfoController@get_student_with_code_student');




                //enterprise

                Route::get('get-option-enterprise','RequestInfoController@get_option_enterprise');
                Route::post('check-exist-info-enterprise','RequestInfoController@check_exist_info_enterprise');
                Route::get('get-info-enterprise','RequestInfoController@get_enterprise_with_email_address_enterprise');
            });




        }); //dùng cho admin

        //enterprise



        Route::group(['prefix' => '/job','name' => 'get.job.','namespace' => 'Job'],function (){
            Route::get('get-list-job','JobController@get_list_job')->name('list_job');
            Route::get('get-list-type-job','JobController@get_list_type_job')->name('list_type_job');
            Route::get('get-list-position','JobController@get_list_position')->name('get_list_position ');
            Route::get('get-list-enterprise','JobController@get_list_enterprise')->name('get_list_enterprise');
            Route::get('get-list-skill','JobController@get_list_skill')->name('get_list_skill');
            Route::get('detail/{id}','JobController@detail')->name('detail');
            Route::get('similar-job/{id}','JobController@get_similar_job')->name('similar.job');



            //enterprise


        });

        Route::group(['prefix' => '/student','name' => 'student.','namespace' => 'Student'],function (){

            Route::get('option-profile','ProfileManageController@option_profile_student');
            Route::get('info','ProfileManageController@info');
            Route::get('/works','ProfileManageController@works');
            Route::get('/get-list-enterprise',['name' => 'get.list.enterprise','uses' => 'ProfileManageController@get_list_enterprise']);

            Route::post('/add-work-excel',['name' => 'add.work.excel','uses' => 'ProfileManageController@add_work_excel']);

            Route::post('/add-work',['name' => 'add.work','uses' => 'ProfileManageController@add_work']);

            Route::delete('/delete-work/{id}',['name' => 'delete.work','uses' => 'ProfileManageController@delete_work']);

            Route::post('/update-avatar',['name' => 'update.avatar','uses' => 'ProfileManageController@update_avatar']);
            Route::put('/update-info',['name' => 'update.info','uses' => 'ProfileManageController@update_info']);
        });*/

    });

    /*Route::post('login',['uses' => 'Auth\AuthController@login']);
    Route::post('checkLogin',['uses' => 'Auth\AuthController@checkLogin'])->middleware('auth:api');
    Route::post('logout',['uses' => 'Auth\AuthController@logout'])->middleware('auth:api');*/
});

