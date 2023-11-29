<?php

Route::group(['namespace' => 'User\UserServiceLimit'], function(){
    Route::resource('users/services/limits', 'UserServiceLimitController', ['except' => ['destroy'], 'as' => 'admin.users.services']);
    Route::get('users/services/limits/{id}/delete', ['as' => 'admin.users.services.limits.delete', 'uses' => 'UserServiceLimitController@destroy']);
});

