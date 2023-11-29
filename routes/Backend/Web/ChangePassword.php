<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 19.11.2020
 * Time: 15:59
 */

Route::group(['namespace' => 'User\Auth'], function () {
    Route::get('changePassword', ['as' => 'admin.changePassword', 'uses' => 'ChangePasswordController@changePasswordView']);
    Route::post('changePassword/changePassword', ['as' => 'admin.changePassword.changePassword', 'uses' => 'ChangePasswordController@changePassword']);
});