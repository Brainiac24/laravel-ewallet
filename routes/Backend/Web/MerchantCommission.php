<?php

Route::group(['namespace' => 'Merchant\MerchantCommission'], function(){

    Route::resource('merchants/commissions', 'MerchantCommissionController', ['except' => ['destroy'], 'as' => 'admin.merchants']);
    Route::get('merchants/commissions/{id}/delete', ['as' => 'admin.merchants.commissions.delete', 'uses' => 'MerchantCommissionController@destroy']);
});