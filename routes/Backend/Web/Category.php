<?php

#CRUD Point #1

Route::group(['namespace' => 'Service\Category'], function(){


    Route::resource('services/categories', 'CategoryController', ['except' => ['destroy'], 'as' => 'admin']);
    Route::get('services/categories/{id}/delete', ['as' => 'admin.categories.delete', 'uses' => 'CategoryController@destroy']);


});

