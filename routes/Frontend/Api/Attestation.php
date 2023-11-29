<?php

Route::group(['namespace' => 'User\Attestation'], function () {
    Route::get('attestations', ['as' => 'frontend.api.attestation', 'uses' => 'AttestationController@getAttestationWithUsage']);
    Route::post('attestations/confirmation', ['as' => 'frontend.api.attestations.confirmation', 'uses' => 'AttestationController@setAttestation']);
});
