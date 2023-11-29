<?php

Route::group(['namespace' => 'Area'], function () {
     Route::get('areas/list', ['as' => 'areas', 'uses' => 'AreaController@areasList']);
     Route::get('areas', ['as' => 'api.v1.areas', 'uses' => 'AreaController@areas']);
});
