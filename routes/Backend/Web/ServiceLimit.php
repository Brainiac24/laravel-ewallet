<?php

#CRUD Point #1

Route::group(['namespace' => 'Service\ServiceLimit'], function(){

    Route::resource('services/limits', 'ServiceLimitController', ['except' => ['destroy'], 'as' => 'admin']);
    Route::get('services/limits/{id}/delete', ['as' => 'admin.limits.delete', 'uses' => 'ServiceLimitController@destroy']);

});

