<?php

Route::group(['namespace' => 'User'], function () {
    Route::group(['namespace' => 'Auth'], function (){
        Route::get('login', 'LoginController@showLoginForm')->name('admin.access.showLoginForm');
        Route::post('login', 'LoginController@login')->name('admin.access.login');
        Route::get('logout', 'LoginController@logout')->name('admin.access.logout');
    });
});