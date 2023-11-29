<?php

Route::group(['namespace' => 'Order\RemoteIdentification'], function () {
    Route::resource('remoteIdentification', 'RemoteIdentificationController', ['except' => ['destroy', 'store'], 'as' => 'admin']);

    Route::patch('remoteIdentification/{id}/reject', ['as' => 'admin.remoteIdentification.reject', 'uses' => 'RemoteIdentificationController@reject']);
    Route::patch('remoteIdentification/{id}/accept', ['as' => 'admin.remoteIdentification.accept', 'uses' => 'RemoteIdentificationController@accept']);
    Route::patch('remoteIdentification/{id}/confirm', ['as' => 'admin.remoteIdentification.confirm', 'uses' => 'RemoteIdentificationController@confirm']);
    Route::post('remoteIdentification/{id}/checkJob', ['as' => 'admin.remoteIdentification.checkJob', 'uses' => 'RemoteIdentificationController@checkJob']);
    Route::post('remoteIdentification/{id}/search', ['as' => 'admin.remoteIdentification.search', 'uses' => 'RemoteIdentificationController@search']);
    Route::post('remoteIdentification/{id}/updateHistory', ['as' => 'admin.remoteIdentification.updateHistory', 'uses' => 'RemoteIdentificationController@updateHistory']);

    Route::get('remoteIdentification/{id}/createClient', ['as' => 'admin.remoteIdentification.createClient', 'uses' => 'RemoteIdentificationController@createClient']);
    Route::get('remoteIdentification/{id}/updateClient', ['as' => 'admin.remoteIdentification.updateClient', 'uses' => 'RemoteIdentificationController@updateClient']);
    Route::get('remoteIdentification/identificationAccountsCheck/run', ['as' => 'admin.remoteIdentification.identificationAccountsCheckRun', 'uses' => 'RemoteIdentificationController@identificationAccountsCheckRun']);

    Route::patch('remoteIdentification/{id}/getInfoNalog', ['as' => 'admin.remoteIdentification.getInfoNalog', 'uses' => 'RemoteIdentificationController@getInfoNalog']);

    Route::get('remoteIdentification/{orderId}/{name}/image', ['as' => 'admin.remoteIdentification.image', 'uses' => 'RemoteIdentificationController@image']);
    Route::get('remoteIdentification/{orderId}/{image}/changeImage', ['as' => 'admin.remoteIdentification.changeImage', 'uses' => 'RemoteIdentificationController@changeImage']);
    Route::get('remoteIdentification/{id}/takeToWork', ['as' => 'admin.remoteIdentification.takeToWork', 'uses' => 'RemoteIdentificationController@takeToWork']);

    Route::get('remoteIdentification/{id}/register', ['as' => 'admin.remoteIdentification.register', 'uses' => 'RemoteIdentificationController@register']);
    Route::get('remoteIdentification/{id}/updateStatus', ['as' => 'admin.remoteIdentification.updateStatus', 'uses' => 'RemoteIdentificationController@updateStatus']);

});