<?php

#CRUD Point #1
// ,'middleware' => ['checkExistToken']
Route::group(['namespace' => 'DocApi'], function(){
    Route::get('docapi', ['as' => 'admin.doc_api.loadApi', 'uses' => 'DocApiController@loadApi']);
});

