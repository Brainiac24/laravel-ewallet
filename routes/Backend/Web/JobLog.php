<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 12.07.2019
 * Time: 9:05
 */


Route::group(['namespace' => 'JobLog'], function () {

    Route::resource('jobLog', 'JobLogController', ['except' => ['destroy', 'update', 'store', 'create'], 'as' => 'admin']);
    Route::get('job/jobHistory/{basefilename}/download/', ['as' => 'admin.job.jobHistory.download', 'uses' => 'JobHistoryController@download']);
    Route::get('jobLog/{id}/archive/', ['as' => 'admin.JobLog.showArchive', 'uses' => 'JobLogController@archiveShow']);
});