<?php

#CRUD Point #1

Route::group(['namespace' => 'Transaction\TransactionStatusDetail'], function(){

    Route::resource('transactions/status-detail', 'TransactionStatusDetailController', ['except' => ['destroy'], 'as' => 'admin.transactions']);
    Route::get('transactions/status-detail/{id}/delete', ['as' => 'admin.transactions.status-detail.delete', 'uses' => 'TransactionStatusDetailController@destroy']);

});

