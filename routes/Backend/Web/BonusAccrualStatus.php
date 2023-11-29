<?php

Route::group(['namespace' => 'Cashback\BonusAccrual\BonusAccrualStatus'], function () {

    Route::resource('bonusAccrualStatus', 'BonusAccrualStatusController', ['except' => ['destroy'], 'as' => 'admin']);
    Route::get('bonusAccrualStatus/{id}/delete', ['as' => 'admin.bonusAccrualStatus.delete', 'uses' => 'BonusAccrualStatusController@destroy']);
});