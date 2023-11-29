<?php

Route::group(['namespace' => 'User'], function () {

    //Route::post('users/change-password', ['as' => 'admin.users.change_password', 'uses' => 'UserController@changePassword']);
    Route::get('users/main', ['as' => 'admin.users.main', 'uses' => 'UserController@getMainData']);
    Route::get('users/full', ['as' => 'admin.users.full', 'uses' => 'UserController@getFullData']);
    Route::put('users', ['as' => 'admin.users.update', 'uses' => 'UserController@update']);
});
