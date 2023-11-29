<?php

#CRUD Point #1

Route::group(['namespace' => 'Gateway'], function(){
    Route::resource('gateways', 'GatewayController', ['except' => ['destroy'], 'as' => 'admin']);
    Route::get('gateways/{id}/delete', ['as' => 'admin.gateways.delete', 'uses' => 'GatewayController@destroy']);
});

