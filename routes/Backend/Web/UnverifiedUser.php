<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 20.08.2019
 * Time: 16:17
 */

Route::group(['namespace' => 'User\UnverifiedUser'], function () {

    Route::resource('users/unverifiedUser', 'UnverifiedUserController', ['except' => ['destroy','create','update','store','edit'], 'as' => 'admin.users']);
});