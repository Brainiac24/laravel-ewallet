<?php

#CRUD Point #1

Route::group(['namespace' => 'CoordinatePoint'], function(){
    Route::resource('coordinatepoints', 'CoordinatePointController', ['except' => ['destroy'], 'as' => 'admin']);
    Route::get('coordinatepoints/{id}/delete', ['as' => 'admin.coordinatepoints.delete', 'uses' => 'CoordinatePointController@destroy']);
});

