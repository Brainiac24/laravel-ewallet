<?php

Route::group(['namespace' => 'CoordinatePoint\CoordinatePointCity'], function () {
    Route::resource('coordinatePointCities', 'CoordinatePointCityController', ['except' => ['destroy'], 'as' => 'admin']);
    Route::get('coordinatePointCities/{id}/delete', ['as' => 'admin.coordinatePointCities.delete', 'uses' => 'CoordinatePointCityController@destroy']);
});