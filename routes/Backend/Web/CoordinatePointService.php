<?php


#CRUD Point #1

Route::group(['namespace' => 'CoordinatePoint\CoordinatePointService'], function () {
    Route::resource('coordinatepointServices', 'CoordinatePointServiceController', ['except' => ['destroy'], 'as' => 'admin']);
    Route::get('coordinatepointServices/{id}/delete', ['as' => 'admin.coordinatepointServices.delete', 'uses' => 'CoordinatePointServiceController@destroy']);
});