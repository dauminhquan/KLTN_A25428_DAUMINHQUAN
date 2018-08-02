<?php

use Illuminate\Support\Facades\Cookie;

Route::get('/',function(\Illuminate\Http\Request $request){
   return $request->cookie('auth');
});

Route::group(['namespace' => 'Auth'],function(){
   Route::get('login',['uses' => 'LoginController@login']);
});

