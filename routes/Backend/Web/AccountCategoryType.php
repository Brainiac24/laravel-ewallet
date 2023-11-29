<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 15.07.2019
 * Time: 16:44
 */

Route::group(['namespace' => 'Account\AccountCategoryType'], function () {

    Route::resource('accounts/category/types', 'AccountCategoryTypeController', ['except' => ['destroy', 'store'], 'as' => 'admin.accounts.category']);
});