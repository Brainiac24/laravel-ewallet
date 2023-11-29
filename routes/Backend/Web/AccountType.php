<?php

#CRUD Point #1

Route::group(['namespace' => 'Account\AccountType'], function(){

    Route::resource('accounts/types', 'AccountTypeController', ['except' => ['destroy'], 'as' => 'admin.accounts']);
    Route::get('accounts/types/{id}/delete', ['as' => 'admin.accounts.types.delete', 'uses' => 'AccountTypeController@destroy']);

});

