<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 20.08.2019
 * Time: 16:17
 */

Route::group(['namespace' => 'Order\OrderType'], function () {

    Route::resource('orders/orderType', 'OrderTypeController', ['except' => ['destroy','create','update','store','edit'], 'as' => 'admin.order']);
});