<?php

Route::group(['namespace' => 'Schedule\ScheduleType'], function(){

    Route::resource('scheduleTypes', 'ScheduleTypeController', ['except' => ['destroy', 'store', 'create', 'edit', 'update'], 'as' => 'admin']);
});