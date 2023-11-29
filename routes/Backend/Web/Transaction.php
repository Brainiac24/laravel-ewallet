<?php

#CRUD Point #1

Route::group(['namespace' => 'Transaction'], function(){

    Route::resource('transactions', 'TransactionController', ['except' => ['destroy','create','store'], 'as' => 'admin']);
    Route::get('transactions/{id}/resend', ['as' => 'admin.transactions.resend', 'uses' => 'TransactionController@resend']);
    Route::get('transactions/{id}/child', ['as' => 'admin.transactions.child_index', 'uses' => 'TransactionController@child_index']);
    Route::get('transactions/{parent_id}/child/{id}', ['as' => 'admin.transactions.child_index', 'uses' => 'TransactionController@showChild']);
    Route::get('transactions/{parent_id}/child/{id}/edit', ['as' => 'admin.transactions.child_index', 'uses' => 'TransactionController@editChild']);
    Route::get('transactions/{id}/continue_process', ['as' => 'admin.transactions.continue_process', 'uses' => 'TransactionController@continue_process']);
    Route::post('transactions/{id}/changeTransactionSyncStatus', ['as' => 'admin.transactions.changeTransactionSyncStatus', 'uses' => 'TransactionController@changeTransactionSyncStatus']);
//    Route::get('transactions/{id}/editStatus', ['as' => 'admin.transactions.editStatus', 'uses' => 'TransactionController@editStatus']);
    //Route::get('transactions/{id}/return', ['as' => 'admin.transactions.return', 'uses' => 'TransactionController@return']);

});

