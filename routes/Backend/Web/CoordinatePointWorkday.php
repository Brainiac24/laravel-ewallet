<?php


#CRUD Point #1

Route::group(['namespace' => 'CoordinatePoint\CoordinatePointWorkday'], function () {
    Route::resource('coordinatepointWorkdays', 'CoordinatePointWorkdayController', ['except' => ['destroy'], 'as' => 'admin']);
    Route::get('coordinatepointWorkdays/{id}/delete', ['as' => 'admin.coordinatepointWorkdays.delete', 'uses' => 'CoordinatePointWorkdayController@destroy']);
});