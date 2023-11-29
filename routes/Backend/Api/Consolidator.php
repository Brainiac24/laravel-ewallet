<?php

Route::group(['namespace' => 'Consolidator'], function () {
     Route::get('consolidator', ['as' => 'consolidator', 'uses' => 'ConsolidatorController@index']);
     Route::post('consolidator', ['as' => 'consolidator', 'uses' => 'ConsolidatorController@noob']);
     Route::put('consolidator', ['as' => 'consolidator', 'uses' => 'ConsolidatorController@noob']);
     Route::delete('consolidator', ['as' => 'consolidator', 'uses' => 'ConsolidatorController@noob']);
});
