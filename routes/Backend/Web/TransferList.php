<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 20.08.2019
 * Time: 16:17
 */

Route::group(['namespace' => 'TransferList'], function () {

    Route::resource('transferList', 'TransferListController', ['except' => ['destroy'], 'as' => 'admin']);
    Route::get('transferList/{id}/delete', ['as' => 'admin.transferList.delete', 'uses' => 'TransferListController@destroy']);
});