<?php


#CRUD Point #1

Route::group(['namespace' => 'CoordinatePoint\CoordinatePointType'], function () {
    Route::resource('coordinatepointTypes', 'CoordinatePointTypeController', ['except' => ['destroy'], 'as' => 'admin']);
    Route::get('coordinatepointTypes/{id}/delete', ['as' => 'admin.coordinatepointTypes.delete', 'uses' => 'CoordinatePointTypeController@destroy']);
});