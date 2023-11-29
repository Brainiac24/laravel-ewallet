<?php

Route::group(['namespace' => 'Schedule\ScheduleJob'], function(){

    Route::get('scheduleJobs/generate-view', ['as' => 'admin.scheduleJobs.generateView', 'uses' => 'ScheduleJobController@generateView']);
    Route::resource('scheduleJobs', 'ScheduleJobController', ['except' => ['destroy', 'edit', 'update'], 'as' => 'admin']);

});