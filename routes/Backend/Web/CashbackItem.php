<?php

Route::group(['namespace' => 'Cashback\CashbackItem'], function () {

    Route::resource('cashbacks/{cashback_id}/items', 'CashbackItemController', ['except' => ['destroy'], 'as' => 'admin.cashback']);
    Route::get('cashbacks/{cashback_id}/items/{id}/delete', ['as' => 'admin.cashback.items.delete', 'uses' => 'CashbackItemController@destroy']);
//    Route::get('cashback/cashbackItem/{id}/delete', ['as' => 'admin.cashback.cashbackItem.delete', 'uses' => 'CashbackItemController@destroy']);
});