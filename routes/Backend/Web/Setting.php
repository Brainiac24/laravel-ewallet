<?php

#CRUD Point #1

Route::group(['namespace' => 'Setting'], function(){

    Route::resource('settings', 'SettingController', ['except' => ['destroy'], 'as' => 'admin']);
    Route::get('settings/{id}/delete', ['as' => 'admin.settings.delete', 'uses' => 'SettingController@destroy']);

});

