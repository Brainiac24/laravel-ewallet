<?php

#CRUD Point #1

Route::group(['namespace' => 'Favorite'], function () {

    Route::resource('favorites', 'FavoriteController', ['except' => ['destroy'], 'as' => 'admin']);
    Route::get('favorites/{id}/delete', ['as' => 'admin.favorites.delete', 'uses' => 'FavoriteController@destroy']);
    Route::get('favorites/{id}/restore', ['as' => 'admin.favorites.delete', 'uses' => 'FavoriteController@restore']);

});

