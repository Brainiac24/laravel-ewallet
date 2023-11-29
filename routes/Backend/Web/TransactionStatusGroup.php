<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 20.08.2019
 * Time: 16:17
 */

Route::group(['namespace' => 'Transaction\TransactionStatusGroup'], function () {

    Route::resource('transactions/status-group', 'TransactionStatusGroupController', ['except' => ['destroy','create','update','store','edit'], 'as' => 'admin.transactions']);
});