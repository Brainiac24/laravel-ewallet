<?php

#CRUD Point #1

Route::group(['namespace' => 'Account\AccountTypeDetail'], function(){

    Route::resource('accounts/types-detail', 'AccountTypeDetailController', ['except' => ['destroy'], 'as' => 'admin.accounts']);
    Route::get('accounts/types-detail/{id}/delete', ['as' => 'admin.accounts.types-detail.delete', 'uses' => 'AccountTypeDetailController@destroy']);

});

