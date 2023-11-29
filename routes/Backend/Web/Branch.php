<?php

#CRUD Point #1

Route::group(['namespace' => 'Branch'], function () {

    Route::resource('branches', 'BranchController', ['except' => ['destroy'], 'as' => 'admin']);
    Route::get('branches/{id}/delete', ['as' => 'admin.branches.delete', 'uses' => 'BranchController@destroy']);
});