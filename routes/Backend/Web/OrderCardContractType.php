<?php
/**
 * Created by PhpStorm.
 * User: Nabijon
 * Date: 07.09.2021
 * Time: 10:43
 */

Route::group(['namespace' => 'Order\OrderCardContractType'], function () {
    Route::resource('cardContractType', 'OrderCardContractTypeController', ['except' => ['destroy','show'], 'as' => 'admin.order']);
    Route::get('cardContractType/{id}/delete', ['as' => 'admin.order.cardContractType.delete', 'uses' => 'OrderCardContractTypeController@destroy']);
});