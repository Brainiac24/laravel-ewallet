<?php

Route::group(['namespace' => 'City'], function () {
     Route::get('city/list', ['as' => 'city', 'uses' => 'CityController@citiesList']);
     Route::get('cities', ['as' => 'api.v1.cities', 'uses' => 'CityController@cities']);
});
