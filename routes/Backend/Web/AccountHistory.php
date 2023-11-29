<?php

#CRUD Point #1

Route::group(['namespace' => 'Account\AccountHistory'], function(){

    Route::resource('accounts/histories', 'AccountHistoryController', ['except' => ['destroy'], 'as' => 'admin.accounts']);
    Route::get('accounts/history/{id}/delete', ['as' => 'admin.accounts.histories.delete', 'uses' => 'AccountHistoryController@destroy']);
});

