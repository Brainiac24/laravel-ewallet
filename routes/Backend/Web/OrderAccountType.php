<?php

Route::group(['namespace' => 'Order\OrderAccountType'], function () {
    Route::resource('orderAccountType', 'OrderAccountTypeController', ['except' => ['destroy','show'], 'as' => 'admin.order']);
    Route::get('orderAccountType/{id}/delete', ['as' => 'admin.order.orderAccountType.delete', 'uses' => 'OrderAccountTypeController@destroy']);
});