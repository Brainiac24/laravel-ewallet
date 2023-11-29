<?php

#CRUD Point #1

Route::group(['namespace' => 'Service'], function(){

    Route::resource('services', 'ServiceController', ['except' => ['destroy'], 'as' => 'admin']);
    Route::get('services/{id}/delete', ['as' => 'admin.service.delete', 'uses' => 'ServiceController@destroy']);
    Route::patch('services/{id}/deleteImageIconUrl', ['as' => 'admin.service.deleteImageIconUrl', 'uses' => 'ServiceController@deleteImageIconUrl']);
    Route::patch('services/{id}/deleteImageInIconUrl', ['as' => 'admin.service.deleteImageInIconUrl', 'uses' => 'ServiceController@deleteImageInIconUrl']);
    Route::patch('services/{id}/deleteImageOutIconUrl', ['as' => 'admin.service.deleteImageOutIconUrl', 'uses' => 'ServiceController@deleteImageOutIconUrl']);

});

