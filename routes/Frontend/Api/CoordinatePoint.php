<?php

Route::group(['namespace' => 'CoordinatePoint'], function () {
    Route::get('coordinates', ['as' => 'frontend.api.coordinates', 'uses' => 'CoordinatePointController@index']);
});
