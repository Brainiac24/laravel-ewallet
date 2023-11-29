<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 17.12.2019
 * Time: 11:01
 */

Route::group(['namespace' => 'Merchant\MerchantWorkdays'], function(){

    Route::resource('merchants/merchantWorkdays', 'MerchantWorkdaysController', ['except' => ['destroy'], 'as' => 'admin.merchants']);
    Route::get('merchants/merchantWorkdays/{id}/delete', ['as' => 'admin.merchants.merchantWorkdays.delete', 'uses' => 'MerchantWorkdaysController@destroy']);
});