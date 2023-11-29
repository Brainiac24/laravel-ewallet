<?php

#CRUD Point #1

Route::group(['namespace' => 'User\Client'], function(){

    Route::resource('clients', 'ClientController', ['except' => ['destroy', 'create', 'store',], 'as' => 'admin']);
    Route::get('clients/{id}/delete', ['as' => 'admin.clients.delete', 'uses' => 'ClientController@destroy']);
    Route::get('clients/{id}/unlock', ['as' => 'admin.clients.unlock', 'uses' => 'ClientController@unlock']);
    Route::get('clients/{id}/block', ['as' => 'admin.clients.block', 'uses' => 'ClientController@block']);
    Route::get('clients/{id}/deleteEmail', ['as' => 'admin.clients.deleteEmail', 'uses' => 'ClientController@deleteEmail']);
    Route::get('clients/{id}/resetPin', ['as' => 'admin.clients.resetPin', 'uses' => 'ClientController@deleteEmail']);
    Route::patch('clients/{id}/identificate', ['as' => 'admin.clients.identificate', 'uses' => 'ClientController@identificate']);
    Route::patch('clients/{id}/addCodeMap', ['as' => 'admin.clients.addCodeMap', 'uses' => 'ClientController@addCodeMap']);
    Route::patch('clients/{id}/deleteCodeMap', ['as' => 'admin.clients.deleteCodeMap', 'uses' => 'ClientController@deleteCodeMap']);
    Route::get('clients/{id}/resetPassword', ['as' => 'admin.clients.resetPassword', 'uses' => 'ClientController@resetPassword']);
    Route::get('clients/{id}/resetIdentification', ['as' => 'admin.clients.resetIdentification', 'uses' => 'ClientController@resetIdentification']);
    Route::patch('clients/{id}/updateLite', ['as' => 'admin.clients.updateLite', 'uses' => 'ClientController@updateLite']);
    Route::get('clients/{id}/deletePin', ['as' => 'admin.clients.deletePin', 'uses' => 'ClientController@deletePin']);

});

