<?php

#CRUD Point #1

Route::group(['namespace' => 'Country'], function(){

    Route::resource('countries', 'CountryController', ['except' => ['destroy'], 'as' => 'admin']);
    Route::get('countries/{id}/delete', ['as' => 'admin.countries.delete', 'uses' => 'CountryController@destroy']);

});