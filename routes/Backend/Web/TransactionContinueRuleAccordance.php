<?php

#CRUD Point #1

Route::group(['namespace' => 'Transaction\TransactionContinueRuleAccordance'], function(){
    Route::resource('transactions/continueRules/{transactionContinueRule_id}/accordance', 'TransactionContinueRuleAccordanceController', ['except' => ['destroy'], 'as' => 'admin.transactions.continueRules']);
    Route::get('transactions/continueRules/{transactionContinueRule_id}/accordance/{id}/delete', ['as' => 'admin.transactions.continueRules.accordance.delete', 'uses' => 'TransactionContinueRuleAccordanceController@destroy']);
});