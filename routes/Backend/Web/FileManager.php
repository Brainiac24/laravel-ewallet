<?php

Route::group(['namespace' => 'FileManager'], function(){
    Route::get('fileManager', ['as' => 'admin.fileManager.index', 'uses' => 'FileManagerController@index']);
    Route::post('fileManager/upload', ['as' => 'admin.fileManager.upload', 'uses' => 'FileManagerController@upload']);
    Route::get('fileManager/delete', ['as' => 'admin.fileManager.delete', 'uses' => 'FileManagerController@delete']);
    Route::get('fileManager/rename', ['as' => 'admin.fileManager.rename', 'uses' => 'FileManagerController@rename']);
    Route::get('fileManager/download', ['as' => 'admin.fileManager.download', 'uses' => 'FileManagerController@download']);
    Route::get('fileManager/mkFolder', ['as' => 'admin.fileManager.mkFolder', 'uses' => 'FileManagerController@mkFolder']);
});