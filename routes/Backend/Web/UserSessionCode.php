<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 20.08.2019
 * Time: 16:17
 */

Route::group(['namespace' => 'User\UserSessionCode'], function () {

    Route::resource('users/userSessionCode', 'UserSessionCodeController', ['except' => ['destroy','create','update','store','edit'], 'as' => 'admin.users']);
});