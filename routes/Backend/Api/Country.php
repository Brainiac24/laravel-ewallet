<?php

Route::group(['namespace' => 'Country'], function () {
     Route::get('countries/list', ['as' => 'countries', 'uses' => 'CountryController@countriesList']);
     Route::get('countries/list/tj', ['as' => 'countries', 'uses' => 'CountryController@countriesListTajikistan']);
});
