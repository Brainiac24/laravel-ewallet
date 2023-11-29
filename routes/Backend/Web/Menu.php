<?php

#CRUD Point #1

Route::group(['namespace' => 'Service\Menu'], function(){

    Route::resource('menu', 'MenuController', ['except' => ['destroy','edit'], 'as' => 'admin']);
    Route::get('menu/{id}/delete/{cat_id}', ['as' => 'admin.menu.delete', 'uses' => 'MenuController@destroy']);
    Route::get('menu/{id}/edit/{cat_id}/position/{position}', ['as' => 'admin.menu.edit', 'uses' => 'MenuController@edit']);

});

