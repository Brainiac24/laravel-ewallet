<?php
Route::group(['namespace' => 'Account\AccountStatus'], function () {
    Route::resource('accounts/status', 'AccountStatusController', ['except' => ['destroy'], 'as' => 'admin.accounts']);
    Route::get('accounts/status/{id}/delete', ['as' => 'admin.accounts.status.delete', 'uses' => 'AccountStatusController@destroy']);

});