<?php

#CRUD Point #1

Route::group(['namespace' => 'Bank'], function () {

    Route::resource('banks', 'BankController', ['except' => ['destroy'], 'as' => 'admin']);
    Route::get('banks/{id}/delete', ['as' => 'admin.banks.delete', 'uses' => 'BankController@destroy']);
});