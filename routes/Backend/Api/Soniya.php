<?php

Route::group(['namespace' => 'Soniya'], function () {
     Route::get('soniyacallbacktest', ['as' => 'soniyacallbacktest', 'uses' => 'SoniyaController@test']);
     Route::post('soniyacallback', ['as' => 'soniyacallback', 'uses' => 'SoniyaController@callBack']);
     Route::put('soniyacallback', ['as' => 'soniyacallback', 'uses' => 'SoniyaController@noob']);
     Route::delete('soniyacallback', ['as' => 'soniyacallback', 'uses' => 'SoniyaController@noob']);
});
