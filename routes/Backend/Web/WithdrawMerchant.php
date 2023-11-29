<?php

#CRUD Point #1

Route::group(['namespace' => 'Report'], function () {

    Route::resource('withdraw_merchant', 'WithdrawMerchantReportController', ['only' => ['index'], 'as' => 'admin']);
    Route::post('withdraw_merchant/run_withdraw_command', ['as' => 'admin.withdraw_merchant.run_withdraw_command', 'uses' => 'WithdrawMerchantReportController@runWithdrawMerchantCommand']);

});

