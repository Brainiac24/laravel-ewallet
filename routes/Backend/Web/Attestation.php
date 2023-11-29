<?php

#CRUD Point #1

Route::group(['namespace' => 'User\Attestation'], function(){

    Route::resource('attestations', 'AttestationController', ['except' => ['destroy'], 'as' => 'admin']);
    Route::get('attestations/{id}/delete', ['as' => 'admin.attestations.delete', 'uses' => 'AttestationController@destroy']);

});

