<?php
/**
 * Created by PhpStorm.
 * User: F_Kosimov
 * Date: 22.08.2018
 * Time: 9:39
 */

//TEST PURPOSE
Route::get('/test_fcm', ['as' => 'admin.testFCM', 'uses' => 'Backend\Web\TestNotification@testFirebase']);
Route::get('/test_sms', ['as' => 'admin.testSMS', 'uses' => 'Backend\Web\TestNotification@testSMS']);
Route::get('/test_proc_pay1', ['as' => 'admin.testProc', 'uses' => 'Backend\Web\TestNotification@testProcessing']);
Route::get('/test_proc_pay2', ['as' => 'admin.testProc2', 'uses' => 'Backend\Web\TestNotification@testprocessing2']);
Route::get('/test_proc_pay3', ['as' => 'admin.testProc3', 'uses' => 'Backend\Web\TestNotification@testprocessing3']);
Route::get('/test_ABSaGetRate', ['as' => 'admin.ABSa', 'uses' => 'Backend\Web\TestNotification@testABSaGet']);
Route::get('/test_ABSrGetRate', ['as' => 'admin.ABSr', 'uses' => 'Backend\Web\TestNotification@testABSrGet']);
//END TEST PURPOSE