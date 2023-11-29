<?php

Route::group(['namespace' => 'User\Role'], function(){

    Route::resource('roles', 'RoleController', ['except' => ['destroy'], 'as' => 'admin']);
    Route::get('roles/{id}/delete', ['as' => 'admin.roles.delete', 'uses' => 'RoleController@destroy']);

});

