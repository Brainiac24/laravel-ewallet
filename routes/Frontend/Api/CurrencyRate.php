<?php

Route::group(['namespace' => 'Currency\CurrencyRate'], function () {
    Route::get('currencies', ['as' => 'frontend.api.currencies', 'uses' => 'CurrencyRateController@index']);
});
