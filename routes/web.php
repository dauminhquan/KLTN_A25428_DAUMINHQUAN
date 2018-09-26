<?php

use App\Models\User;

Route::group(['middleware' => 'web.check.auth'],function(){
    Route::get('/',['uses' => 'HomeController@index','as' => 'home'])->middleware(['web.check.auth']);
    Route::group(['as' => 'tasks.'],function(){
        Route::get('/tasks',['uses' => 'TaskController@index'])->name('index');
        Route::get('/tasks/{id}',['uses' => 'TaskController@info'])->name('info');
        Route::get('/tasks/{id}/get-file',['uses' => 'TaskController@getFile'])->name('get.file');
    });
    Route::group(['as' => 'notifies.'],function(){
        Route::get('/notifies',['uses' => 'NotifyController@index'])->name('index');
        Route::get('/notifies/{id}',['uses' => 'NotifyController@info'])->name('info');
    });

    Route::group(['as' => 'events.'],function(){

        Route::get('/events',['uses' => 'EventController@index'])->name('index');
        Route::get('/events/{id}',['uses' => 'EventController@info'])->name('info');
    });
    Route::post('/change-password',function(\Illuminate\Http\Request $request){
        if($request->has('password') && $request->has('rep_password') && $request->has('old_password'))
        {
            if($request->rep_password != $request->password)
            {
                return back()->withErrors(['not_same' => true]);
            }
            $user = session('user');
            $user = User::where('email',$user->email)->first();
            if(\Illuminate\Support\Facades\Hash::check($request->old_password,$user->password))
            {
                $user->password = \Illuminate\Support\Facades\Hash::make($request->password);
                $user->update();
                return back();
            }
            return back()->withErrors(['not_true' => 1]);
        }
        abort(404);
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

            if($user->accept_token == $request->token && $user->accept_token != null)
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
