<?php

#CRUD Point #1

Route::group(['namespace' => 'DocumentType'], function () {

    Route::resource('documentTypes', 'DocumentTypeController', ['except' => ['destroy'], 'as' => 'admin']);
    Route::get('documentTypes/{id}/delete', ['as' => 'admin.documentType.delete', 'uses' => 'DocumentTypeController@destroy']);
});