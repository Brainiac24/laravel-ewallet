<?php

Route::group(['namespace' => 'Merchant\MerchantCommissionItem'], function(){

    Route::resource('merchants/commissions/{merchant_commission_id}/items', 'MerchantCommissionItemController', ['except' => ['destroy'], 'as' => 'admin.merchants.commission']);
    Route::get('merchants/commissions/{merchant_commission_id}/items/{id}/delete', ['as' => 'admin.merchants.commission.items.delete', 'uses' => 'MerchantCommissionItemController@destroy']);
});