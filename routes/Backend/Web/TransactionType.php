<?php

#CRUD Point #1

Route::group(['namespace' => 'Transaction\TransactionType'], function(){

    Route::resource('transactions/type', 'TransactionTypeController', ['except' => ['destroy'], 'as' => 'admin.transactions']);
    Route::get('transactions/type/{id}/delete', ['as' => 'admin.transactions.type.delete', 'uses' => 'TransactionTypeController@destroy']);

});

