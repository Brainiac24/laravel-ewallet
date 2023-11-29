<?php

Route::group(['namespace' => 'Currency'], function(){

    Route::resource('currencies', 'CurrencyController', ['except' => ['destroy'], 'as' => 'admin']);
    Route::get('currencies/{id}/delete', ['as' => 'admin.currencies.delete', 'uses' => 'CurrencyController@destroy']);

});

