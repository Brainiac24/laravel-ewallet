<?php

#CRUD Point #1

Route::group(['namespace' => 'Transaction\TransactionHistory'], function(){

    Route::resource('transactions/histories', 'TransactionHistoryController', ['except' => ['destroy','update','create', 'edit','store'], 'as' => 'admin.transactions']);
    //Route::get('transactions/histories/{id}/delete', ['as' => 'admin.transactions.histories.delete', 'uses' => 'TransactionHistoryController@destroy']);

});

