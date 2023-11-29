<?php

#CRUD Point #1

Route::group(['namespace' => 'Order'], function () {

    Route::resource('orders', 'OrderController', ['except' => ['destroy','create','store'], 'as' => 'admin']);
});