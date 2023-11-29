<?php

Route::group(['namespace' => 'LicenseAgreement'], function () {
    Route::get('license', ['as' => 'frontend.api.license', 'uses' => 'LicenseAgreementController@index']);
});
