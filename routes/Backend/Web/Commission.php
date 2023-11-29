<?php

Route::group(['namespace' => 'Service\Commission'], function(){
    Route::post('services/commissions/{id}/data', ['as' => 'admin.services.commissions.storeCommissionData', 'uses' => 'CommissionController@storeCommissionData']);
    Route::resource('services/commissions', 'CommissionController', ['except' => ['destroy'], 'as' => 'admin.services']);
    Route::get('services/commissions/{id}/delete', ['as' => 'admin.services.commissions.delete', 'uses' => 'CommissionController@destroy']);
    Route::post('services/commissions/{id}/deleteCommissionData', ['as' => 'admin.services.commissions.deleteCommissionData', 'uses' => 'CommissionController@destroyCommissionData']);
});