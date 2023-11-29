<?php

#CRUD Point #1

Route::group(['namespace' => 'Area'], function(){

    Route::resource('areas', 'AreaController', ['except' => ['destroy'], 'as' => 'admin']);
    Route::get('areas/{id}/delete', ['as' => 'admin.areas.delete', 'uses' => 'AreaController@destroy']);
    Route::post('areas/getByRegionId', ['as' => 'admin.areas.getByRegionId', 'uses' => 'AreaController@getByRegionId']);
});