<?php

Route::group(['namespace' => 'Currency\CurrencyRate'], function(){

    Route::resource('currencies/rates', 'CurrencyRateController', ['except' => ['destroy', 'create', 'store'], 'as' => 'admin.currencies']);
    Route::get('currencies/rates/{id}/delete', ['as' => 'admin.currencies.rates.delete', 'uses' => 'CurrencyRateController@destroy']);

});

