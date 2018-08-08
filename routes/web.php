<?php

use App\Models\User;

Route::group(['middleware' => 'web.check.auth'],function(){
    Route::get('/',['uses' => 'HomeController@index','as' => 'home'])->middleware(['web.check.auth']);
    Route::group(['as' => 'tasks.'],function(){
        Route::get('/tasks',['uses' => 'TaskController@index'])->name('index');
        Route::get('/tasks/{id}',['uses' => 'TaskController@info'])->name('info');
    });
    Route::group(['as' => 'notifies.'],function(){
        Route::get('/notifies',['uses' => 'NotifyController@index'])->name('index');
        Route::get('/notifies/{id}',['uses' => 'NotifyController@info'])->name('info');
    });

    Route::group(['as' => 'events.'],function(){

        Route::get('/events',['uses' => 'EventController@index'])->name('index');
        Route::get('/events/{id}',['uses' => 'EventController@info'])->name('info');
    });


});

Route::group(['namespace' => 'Auth'],function(){
    Route::get('login',['uses' => 'AuthController@login','as' => 'login']);
});

Route::get('authentication-user',function(\Illuminate\Http\Request $request){
    if($request->has('email') && $request->has('token'))
    {
        $user = User::where('email',$request->email)->first();
        if($user != null)
        {

            if($user->accept_token == $request->token)
            {

                $user->authentication = 1;
                $user->accept_token = null;
                $user->update();
                return response()->redirectToRoute('web.login')->withErrors('Tài khoản đã được xác thực thành công');
            }
        }
    }
    abort(404);
})->name('accept.user');


