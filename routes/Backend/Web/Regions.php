<?php

#CRUD Point #1

Route::group(['namespace' => 'Region'], function(){

    Route::resource('regions', 'RegionController', ['except' => ['destroy'], 'as' => 'admin']);
    Route::get('regions/{id}/delete', ['as' => 'admin.regions.delete', 'uses' => 'RegionController@destroy']);
    Route::post('regions/getByCountyId', ['as' => 'admin.regions.getByCountyId', 'uses' => 'RegionController@getByCountyId']);
});