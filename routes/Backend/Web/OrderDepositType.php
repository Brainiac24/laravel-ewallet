<?php

Route::group(['namespace' => 'Order\OrderDepositType'], function () {
    Route::resource('orderDepositType', 'OrderDepositTypeController', ['except' => ['destroy','show'], 'as' => 'admin.order']);
    Route::get('orderDepositType/{id}/delete', ['as' => 'admin.order.orderDepositType.delete', 'uses' => 'OrderDepositTypeController@destroy']);
});