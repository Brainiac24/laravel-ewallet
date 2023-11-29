<?php

Route::group(['namespace' => 'Job\JobHistory'], function () {
    Route::get('job/jobHistory/command', ['as' => 'admin.job.jobHistory.command', 'uses' => 'JobHistoryController@indexCommand']);
    Route::resource('job/jobHistory', 'JobHistoryController', ['except' => ['destroy', 'update', 'store', 'create'], 'as' => 'admin']);
    Route::get('job/jobHistory/{basefilename}/download/', ['as' => 'admin.job.jobHistory.download', 'uses' => 'JobHistoryController@download']);
});