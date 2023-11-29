<?php

Route::group(['namespace' => 'Currency\CurrencyRateHistory'], function(){

    Route::resource('currencies/rates/histories', 'CurrencyRateHistoryController', ['except' => ['destroy'], 'as' => 'admin.currencies.rates']);
    Route::get('currencies/rates/histories/{id}/delete', ['as' => 'admin.currencies.rates.histories.delete', 'uses' => 'CurrencyRateHistoryController@destroy']);

});

