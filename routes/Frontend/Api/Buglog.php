<?php

Route::group(['namespace' => 'Buglog'], function () {
    Route::post('buglog', ['as' => 'frontend.api.coordinates', 'uses' => 'BuglogController@log']);
});
