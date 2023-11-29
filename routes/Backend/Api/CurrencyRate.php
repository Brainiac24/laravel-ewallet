<?php

#CRUD Point #1

Route::group(['namespace' => 'Currency\CurrencyRate'], function(){
    Route::post('currencies/rates', ['as' => 'admin.api.rates.store', 'uses' => 'CurrencyRateController@store']);
});