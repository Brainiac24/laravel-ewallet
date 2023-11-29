<?php

Route::group(['namespace' => 'Order\OrderCardType'], function () {
    Route::resource('orderCardType', 'OrderCardTypeController', ['except' => ['destroy','show'], 'as' => 'admin.order']);
    Route::get('orderCardType/{id}/delete', ['as' => 'admin.order.orderCardType.delete', 'uses' => 'OrderCardTypeController@destroy']);
    Route::get('orderCardType/icon/{icon}/delete', ['as' => 'admin.order.orderCardType.deleteImage', 'uses' => 'OrderCardTypeController@deleteImage']);
});