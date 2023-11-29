<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 01.11.2019
 * Time: 10:26
 */

Route::group(['namespace' => 'Merchant'], function () {

    Route::resource('merchants', 'MerchantController', ['except' => ['destroy'], 'as' => 'admin']);
    Route::get('merchants/{id}/delete', ['as' => 'admin.merchants.delete', 'uses' => 'MerchantController@destroy']);
    Route::patch('merchants/{id}/deleteImageLogo', ['as' => 'admin.merchants.deleteImageLogo', 'uses' => 'MerchantController@deleteImageLogo']);
    Route::patch('merchants/{id}/deleteImageAd', ['as' => 'admin.merchants.deleteImageAd', 'uses' => 'MerchantController@deleteImageAd']);
    Route::patch('merchants/{id}/deleteImageDetail', ['as' => 'admin.merchants.deleteImageDetail', 'uses' => 'MerchantController@deleteImageDetail']);
    Route::get('merchants/{id}/generateLogin', ['as' => 'admin.merchants.generateLogin', 'uses' => 'MerchantController@generateLogin']);
    Route::get('merchants/{id}/deleteContract/{file}', ['as' => 'admin.merchants.deleteContract', 'uses' => 'MerchantController@deleteContract']);
    Route::get('merchants/{id}/downloadContract/{file}', ['as' => 'admin.merchants.downloadContract', 'uses' => 'MerchantController@downloadContract']);
});