<?php

Route::group(['namespace' => 'Cashback\CashbackType'], function () {

    Route::resource('cashbackTypes', 'CashbackTypeController', ['except' => ['destroy'], 'as' => 'admin']);
    Route::get('cashbackTypes/{id}/delete', ['as' => 'admin.cashbackType.delete', 'uses' => 'CashbackTypeController@destroy']);
});