<?php

#CRUD Point #1

Route::group(['namespace' => 'Error'], function(){
    Route::get('forbidden', ['as' => 'admin.errors.index', 'uses' => 'ErrorController@index']);
});