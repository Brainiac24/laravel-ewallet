<?php

Route::group(['namespace' => 'User'], function(){

    Route::resource('users', 'UserController', ['except' => ['destroy'], 'as' => 'admin']);
    Route::get('users/{id}/delete', ['as' => 'admin.users.delete', 'uses' => 'UserController@destroy']);
    Route::get('users/{id}/unlock', ['as' => 'admin.users.unlock', 'uses' => 'UserController@unlock']);
    Route::get('users/{id}/block', ['as' => 'admin.users.block', 'uses' => 'UserController@block']);
    Route::get('users/{id}/deleteEmail', ['as' => 'admin.users.deleteEmail', 'uses' => 'UserController@deleteEmail']);
});

