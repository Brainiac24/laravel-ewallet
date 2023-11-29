<?php

Route::group(['namespace' => 'Schedule'], function(){

    Route::resource('schedules', 'ScheduleController', ['except' => ['destroy'], 'as' => 'admin']);
    Route::get('schedules/{id}/delete', ['as' => 'admin.schedules.delete', 'uses' => 'ScheduleController@destroy']);

});