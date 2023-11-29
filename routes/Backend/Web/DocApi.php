<?php

#CRUD Point #1

Route::group(['namespace' => 'DocApi'], function(){

    Route::get('docapi/index', ['as' => 'admin.doc_api.index', 'uses' => 'DocApiController@index']);

});

