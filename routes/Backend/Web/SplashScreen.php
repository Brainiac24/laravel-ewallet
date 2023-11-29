<?php
#CRUD Point #1

Route::group(['namespace' => 'SplashScreen'], function () {

    Route::get('splashScreens/', ['as' => 'admin.splashScreens.index', 'uses' => 'SplashScreenController@index']);
    Route::post('splashScreens/store', ['as' => 'admin.splashScreens.store', 'uses' => 'SplashScreenController@store']);

});