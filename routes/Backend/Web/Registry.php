<?php

#CRUD Point #1

Route::group(['namespace' => 'Report'], function () {

    Route::resource('registries', 'RegistryController', ['only' => ['index'], 'as' => 'admin']);
//    Route::get('registries/{id}/delete', ['as' => 'admin.accounts.delete', 'uses' => 'AccountController@destroy']);

});

