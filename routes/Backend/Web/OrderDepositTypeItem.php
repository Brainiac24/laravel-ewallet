<?php

Route::group(['namespace' => 'Order\OrderDepositTypeItem'], function () {
    Route::resource('orderDepositTypeItem', 'OrderDepositTypeItemController', ['except' => ['destroy','show'], 'as' => 'admin.order']);
    Route::get('orderDepositTypeItem/{id}/delete', ['as' => 'admin.order.orderDepositTypeItem.delete', 'uses' => 'OrderDepositTypeItemController@destroy']);
});