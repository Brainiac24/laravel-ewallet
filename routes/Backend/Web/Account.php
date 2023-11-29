<?php

#CRUD Point #1

Route::group(['namespace' => 'Account'], function(){

    Route::resource('accounts', 'AccountController', ['except' => ['destroy', 'create', 'store'], 'as' => 'admin']);
    Route::get('accounts/{id}/delete', ['as' => 'admin.accounts.delete', 'uses' => 'AccountController@destroy']);

});

