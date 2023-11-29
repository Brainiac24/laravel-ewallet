<?php

#CRUD Point #1

Route::group(['namespace' => 'Transaction\TransactionContinueRule'], function(){

    Route::resource('transactions/continueRules', 'TransactionContinueRuleController', ['except' => ['destroy'], 'as' => 'admin.transactions']);
    Route::get('transactions/continueRules/{id}/delete', ['as' => 'admin.transactions.continueRules.delete', 'uses' => 'TransactionContinueRuleController@destroy']);

});