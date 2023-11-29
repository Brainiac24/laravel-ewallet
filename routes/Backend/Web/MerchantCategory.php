<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 17.12.2019
 * Time: 11:01
 */

Route::group(['namespace' => 'Merchant\MerchantCategory'], function(){

    Route::resource('merchants/categories', 'MerchantCategoryController', ['except' => ['destroy'], 'as' => 'admin.merchants']);
    Route::get('merchants/categories/{id}/delete', ['as' => 'admin.merchants.categories.delete', 'uses' => 'MerchantCategoryController@destroy']);
});