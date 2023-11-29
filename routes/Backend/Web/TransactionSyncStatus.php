<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 20.08.2019
 * Time: 16:17
 */

Route::group(['namespace' => 'Transaction\TransactionSyncStatus'], function () {

    Route::resource('transactions/sync-status', 'TransactionSyncStatusController', ['except' => ['destroy','create','update','store','edit'], 'as' => 'admin.transactions']);
});