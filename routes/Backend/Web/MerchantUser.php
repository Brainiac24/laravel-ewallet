<?php

Route::group(['namespace' => 'Merchant\MerchantUser'], function () {

    Route::resource('merchants/users', 'MerchantUserController', ['except' => ['destroy','create','store'], 'as' => 'admin.merchants']);
//    Route::get('merchants/users/index', ['MerchantUserController@index', 'as' => 'admin.merchants.index']);
    Route::get('merchants/users/{id}/delete', ['as' => 'admin.merchants.users.delete', 'uses' => 'MerchantUserController@destroy']);
});