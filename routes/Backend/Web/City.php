<?php

#CRUD Point #1

Route::group(['namespace' => 'City'], function(){

    Route::resource('city', 'CityController', ['except' => ['destroy'], 'as' => 'admin']);
    Route::get('city/{id}/delete', ['as' => 'admin.city.delete', 'uses' => 'CityController@destroy']);
    Route::post('cities/getByAreaId', ['as' => 'admin.cities.getByAreaId', 'uses' => 'CityController@getByAreaId']);
});