<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 11.10.2019
 * Time: 09:39
 */

Route::group(['namespace' => 'Service\ServiceOtpLimit'], function () {

    Route::resource('services/serviceOtpLimits', 'ServiceOtpLimitController', ['except' => ['destroy'], 'as' => 'admin']);
    Route::get('services/serviceOtpLimits/{id}/delete', ['as' => 'admin.serviceOtpLimits.delete', 'uses' => 'ServiceOtpLimitController@destroy']);
});