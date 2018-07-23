<?php
/**
 * Created by PhpStorm.
 * User: quand
 * Date: 7/18/2018
 * Time: 8:47 AM
 */

Route::get('/profile','ProfileManageController@index')->name('profile');
Route::get('/profile/update','ProfileManageController@update')->name('update.profile');