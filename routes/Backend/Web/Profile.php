<?php

Route::group(['namespace' => 'User\Profile'], function(){
    Route::get('profile', ['as' => 'admin.profile', 'uses' => 'ProfileController@profile']);
    Route::patch('profile/update', ['as' => 'admin.profile.update', 'uses' => 'ProfileController@update']);
});

