<?php

Route::group(['namespace' => 'Service\Category'], function () {
    //Route::get('categories/{size}', ['as' => 'frontend.api.categories', 'uses' => 'CategoryController@getCategories']);
    Route::get('categories', ['as' => 'frontend.api.categories', 'uses' => 'CategoryController@getCategories']);
});
