<?php

#CRUD Point #1

Route::group(['namespace' => 'Color'], function () {

    Route::patch('colors/{id}/update', ['as' => 'admin.colors.update', 'uses' => 'ColorController@update']);
    Route::resource('colors', 'ColorController', ['except' => ['destroy','update'], 'as' => 'admin']);
    Route::get('colors/{id}/delete', ['as' => 'admin.colors.delete', 'uses' => 'ColorController@destroy']);
});