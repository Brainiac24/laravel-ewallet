<?php

Route::group(['namespace' => 'Cashback\BonusAccrual'], function () {

    Route::resource('bonusAccrual', 'BonusAccrualController', ['except' => ['destroy', 'create', 'update', 'store'], 'as' => 'admin']);
});