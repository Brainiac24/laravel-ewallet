<?php

Route::group(['namespace' => 'Setting'], function () {
    Route::get('settings/notifications', ['as' => 'frontend.api.settings.notifications', 'uses' => 'SettingController@getList']);
    Route::put('settings/notifications', ['as' => 'frontend.api.settings.notifications', 'uses' => 'SettingController@update']);
});
