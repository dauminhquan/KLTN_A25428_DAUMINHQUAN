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

           /* // quan ly sinh vien
            Route::group(['prefix' => '/student-manage','name' => 'student.manage.'],function (){
                //them sinh vien bang file excel
                Route::post('/add-student-excel',['name' => 'add.student.excel','uses' => 'StudentManageController@add_student_excel']);
                Route::post('/add-work-student-excel',['name' => 'add.work.student.excel','uses' => 'StudentManageController@add_work_student_excel']);

                Route::post('/add-work-student',['name' => 'add.work.student.excel','uses' => 'StudentManageController@add_work_student']);



                Route::get('/get-list-student',['name' => 'get.list.student','uses' => 'StudentManageController@get_list_student']);
                Route::delete('/delete-list-student',['name' => 'delete.list.student','uses' => 'StudentManageController@delete_list_student']);
                Route::delete('/delete-student',['name' => 'delete.student','uses' => 'StudentManageController@delete_student']);
                Route::post('/add-student',['name' => 'add.student','uses' => 'StudentManageController@add_student']);
                Route::put('/update-student',['name' => 'add.student','uses' => 'StudentManageController@update_student']);
                Route::post('/update-avatar-student',['name' => 'update.avatar.student','uses' => 'StudentManageController@update_avatar_student']);

                Route::get('/get-work-student',['name' => 'get.work.student','uses' => 'StudentManageController@get_work_student']);
                Route::post('/update-work-student/{id}',['name' => 'update.work.student','uses' => 'StudentManageController@update_work_student']);
                Route::delete('/delete-work-student/{id}',['name' => 'delete.work.student','uses' => 'StudentManageController@delete_work_student']);

                Route::get('/get-list-enterprise',['name' => 'get.list.enterprise','uses' => 'StudentManageController@get_list_enterprise']);




            });
            // quan ly doanh nghiẹp*/

            Route::group(['prefix' => '/manage-enterprises'],function (){
                //them sinh vien bang file excel
                /*Route::post('/add-enterprise-excel',['name' => 'add.enterprise.excel','uses' => 'EnterpriseManageController@add_enterprise_excel']);
                Route::get('/get-list-enterprise',['name' => 'get.list.enterprise','uses' => 'EnterpriseManageController@get_list_enterprise']);
                Route::delete('/delete-list-enterprise',['name' => 'delete.list.enterprise','uses' => 'EnterpriseManageController@delete_list_enterprise']);
                Route::delete('/delete-enterprise',['name' => 'delete.enterprise','uses' => 'EnterpriseManageController@delete_enterprise']);
                Route::post('/add-enterprise',['name' => 'add.enterprise','uses' => 'EnterpriseManageController@add_enterprise']);
                Route::put('/update-enterprise',['name' => 'add.enterprise','uses' => 'EnterpriseManageController@update_enterprise']);
                Route::post('/update-avatar-enterprise',['name' => 'update.avatar.enterprise','uses' => 'EnterpriseManageController@update_avatar_enterprise']);
                Route::get('/get-employees-enterprise',['name' => 'get.employee.enterprise','uses' => 'EnterpriseManageController@get_employee_enterprise']);*/

                Route::resource('/resource','EnterpriseManageController')->except(['create','edit']);
                Route::delete('delete-list','EnterpriseManageController@delete');
                Route::post('update-avatar/{id}','EnterpriseManageController@updateAvatar');

            });

           /* //job
            Route::group(['prefix' => '/job-manage','name' => 'job.manage.'],function (){
                //
                Route::get('/get-list-position',['name' => 'get.list.position','uses' => 'JobManageController@get_list_position']);
                Route::post('/add-position',['name' => 'add.position','uses' => 'JobManageController@add_position']);
                Route::delete('/delete-list-position',['name' => 'delete.list.position','uses' => 'JobManageController@delete_list_position']);
                Route::delete('/delete-position',['name' => 'delete.position','uses' => 'JobManageController@delete_position']);
                Route::put('/edit-position',['name' => 'edit.position','uses' => 'JobManageController@edit_position']);


                //skill

                Route::get('/get-list-skill',['name' => 'get.list.skill','uses' => 'JobManageController@get_list_skill']);
                Route::post('/add-skill',['name' => 'add.skill','uses' => 'JobManageController@add_skill']);
                Route::delete('/delete-list-skill',['name' => 'delete.list.skill','uses' => 'JobManageController@delete_list_skill']);
                Route::delete('/delete-skill',['name' => 'delete.skill','uses' => 'JobManageController@delete_skill']);
                Route::put('/edit-skill',['name' => 'edit.skill','uses' => 'JobManageController@edit_skill']);

                Route::get('/get-list-post',['name' => 'get.list.post','uses' => 'JobManageController@get_list_post']);
                Route::put('/accept-post/{id}',['name' => 'accept.post','uses'=> 'JobManageController@accept_post']);
                Route::get('get-detail-post/{id}',['name' => 'get.detail.post','uses' => 'JobManageController@get_detail_post']);
            });
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

        Route::group(['prefix' => '/enterprise','name' => 'enterprise','namespace' => 'Enterprise'],function (){
            Route::group(['middleware' => ['api.check.enterprise.or.admin']],function(){
                Route::resource('post','PostController')->except(['create','store','edit','update']);
                Route::delete('post','PostController@delete_list_post');
                Route::post('post/{id}','PostController@update');
                Route::resource('post-course','PostCourseController')->except(['create','store','edit','update']);
                Route::delete('post-course','PostCourseController@delete_list_post_course');
                Route::post('post-course/{id}','PostCourseController@update');

            });
            Route::group(['middleware' => 'api.check.enterprise'],function (){
                Route::post('post','PostController@store');
                Route::post('post-course','PostCourseController@store');

                Route::get('option-profile','ProfileManageController@option_profile_enterprise');
                Route::get('info','ProfileManageController@info');
                Route::get('/employees','ProfileManageController@employees');
            });





        });

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

