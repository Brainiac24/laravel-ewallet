<?php

Route::group(['namespace' => 'Account'], function () {
    Route::get('accounts/summary/{account_number}', ['as' => 'frontend.api.accounts', 'uses' => 'AccountController@getBalanceByNumber']);
    Route::get('accounts/{account_number}', ['as' => 'frontend.api.accounts', 'uses' => 'AccountController@getBalanceWithLimitsByAccountNumber']);
});
