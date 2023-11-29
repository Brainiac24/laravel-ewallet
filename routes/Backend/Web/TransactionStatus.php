<?php

#CRUD Point #1

Route::group(['namespace' => 'Transaction\TransactionStatus'], function(){

    Route::resource('transactions/status', 'TransactionStatusController', ['except' => ['destroy'], 'as' => 'admin.transactions']);
    Route::get('transactions/status/{id}/delete', ['as' => 'admin.transactions.status.delete', 'uses' => 'TransactionStatusController@destroy']);

});

