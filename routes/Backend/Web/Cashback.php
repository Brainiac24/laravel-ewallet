<?php

#CRUD Point #1

Route::group(['namespace' => 'Cashback'], function () {

    Route::resource('cashbacks', 'CashbackController', ['except' => ['destroy'], 'as' => 'admin']);
    Route::get('cashbacks/{id}/delete', ['as' => 'admin.cashbacks.delete', 'uses' => 'CashbackController@destroy']);
});