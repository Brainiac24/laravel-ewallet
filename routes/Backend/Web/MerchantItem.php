<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 01.11.2019
 * Time: 10:27
 */
Route::group(['namespace' => 'Merchant\MerchantItem'], function () {

    Route::resource('merchants/{merchant_id}/items', 'MerchantItemController', ['except' => ['destroy'], 'as' => 'admin.merchants']);
    Route::get('merchants/{merchant_id}/items/{id}/delete', ['as' => 'admin.merchants.items.delete', 'uses' => 'MerchantItemController@destroy']);
    Route::post('merchants/items/{id}/changeAccCode', ['as' => 'admin.merchants.items.changeAccCode', 'uses' => 'MerchantItemController@changeAccCode']);
    Route::get('merchants/{merchant_id}/items/{id}/generateHash', ['as' => 'admin.merchants.items.generateHash', 'uses' => 'MerchantItemController@generateHash']);
    Route::get('merchants/{merchant_id}/items/{id}/settingJson', ['as' => 'admin.merchants.items.settingJson', 'uses' => 'MerchantItemController@settingJson']);
});
