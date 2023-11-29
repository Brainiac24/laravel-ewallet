<?php

Route::group(['namespace' => 'Identification'], function () {
     Route::get('identification', ['as' => 'identification', 'uses' => 'IdentificationController@noob']);
     Route::post('identification', ['as' => 'identification', 'uses' => 'IdentificationController@index']);
     Route::put('identification', ['as' => 'identification', 'uses' => 'IdentificationController@noob']);
     Route::delete('identification', ['as' => 'identification', 'uses' => 'IdentificationController@noob']);
});
