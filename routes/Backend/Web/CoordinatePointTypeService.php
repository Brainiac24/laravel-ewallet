<?php


#CRUD Point #1

Route::group(['namespace' => 'CoordinatePoint\CoordinatePointTypeService'], function () {
    Route::resource('coordinatepointTypes/{type_id}/services', 'CoordinatePointTypeServiceController', ['except' => ['destroy','index'], 'as' => 'admin.coordinatepointTypes']);
    Route::get('coordinatepointTypes/{type_id}/services/{id}/delete', ['as' => 'admin.coordinatepointTypes.services.delete', 'uses' => 'CoordinatePointTypeServiceController@destroy']);
});