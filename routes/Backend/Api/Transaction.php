<?php

#CRUD Point #1

Route::group(['namespace' => 'Transaction'], function(){

    Route::post('transactions/status', ['as' => 'admin.transaction.changeStatus', 'uses' => 'TransactionController@changeStatusAndCalculateBalance']);
});