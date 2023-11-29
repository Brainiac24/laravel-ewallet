<?php

Route::group(['namespace' => 'Order\OrderAccountTypeItem'], function () {
    Route::resource('orderAccountTypeItem', 'OrderAccountTypeItemController', ['except' => ['destroy','show'], 'as' => 'admin.order']);
    Route::get('orderAccountTypeItem/{id}/delete', ['as' => 'admin.order.orderAccountTypeItem.delete', 'uses' => 'OrderAccountTypeItemController@destroy']);
});