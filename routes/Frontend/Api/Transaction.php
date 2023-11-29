<?php

Route::group (['namespace' => 'Transaction'], function () {
    Route::post('transactions', ['as' => 'frontend.api.transaction.create', 'uses' => 'TransactionController@create']);
    Route::get('transactions/histories', ['as' => 'frontend.api.transaction.histories', 'uses' => 'TransactionController@getList']);
    Route::post('transactions/balance', ['as' => 'frontend.api.transaction.check.balance', 'uses' => 'TransactionController@checkBalanceFromProcessing']);
    Route::get('transactions/confirm/retry/{id}', ['as' => 'frontend.api.transaction.confirm.sms.retry', 'uses' => 'TransactionController@retrySendSMS']);
    Route::post('transactions/confirm', ['as' => 'frontend.transactions.confirm.sms', 'uses' => 'TransactionController@confirm']);
    Route::get('transactions/{id}', ['as' => 'frontend.api.transaction.detail', 'uses' => 'TransactionController@getById']);
    Route::get('transactions/receipt/{id}', ['as' => 'frontend.api.transaction.reciept', 'uses' => 'TransactionController@getByIdForReciept']);
    Route::post('transactions/fill', ['as' => 'frontend.api.transaction.fill', 'uses' => 'TransactionController@fill']);
});


