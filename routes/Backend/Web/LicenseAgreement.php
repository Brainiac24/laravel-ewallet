<?php
Route::group(['namespace' => 'LicenseAgreement'], function(){
    Route::get('license/edit', ['as' => 'admin.license.edit', 'uses' => 'LicenseAgreementController@edit']);
    Route::post('license/store',  ['as' => 'admin.license.store', 'uses' => 'LicenseAgreementController@store']);
});

