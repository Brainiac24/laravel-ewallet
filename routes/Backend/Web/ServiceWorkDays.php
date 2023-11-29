<?php

#CRUD Point #1

Route::group(['namespace' => 'Service\WorkDays'], function(){

    Route::resource('services/workdays', 'ServiceWorkDaysController', ['except' => ['destroy'], 'as' => 'admin']);
    Route::get('services/workdays/{id}/delete', ['as' => 'admin.workdays.delete', 'uses' => 'ServiceWorkDaysController@destroy']);

});

