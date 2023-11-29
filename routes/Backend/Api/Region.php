<?php

Route::group(['namespace' => 'Region'], function () {
     Route::get('regions/list', ['as' => 'regions', 'uses' => 'RegionController@regionsList']);
     Route::get('regions', ['as' => 'api.v1.regions', 'uses' => 'RegionController@regions']);
});
