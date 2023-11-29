<?php
/**
 * Created by PhpStorm.
 * User: Nabijon
 * Date: 01.09.2021
 * Time: 11:00
 */
Route::group(['namespace' => 'DwhRule'], function () {
    Route::resource('DwhRule', 'DwhRuleController', ['except' => ['destroy'], 'as' => 'admin']);
    Route::get('DwhRule/{id}/delete', ['as' => 'admin.DwhRule.delete', 'uses' => 'DwhRuleController@destroy']);
});