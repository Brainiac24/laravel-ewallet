<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 27.09.2019
 * Time: 11:39
 */

Route::group(['namespace' => 'News'], function () {

    Route::resource('news', 'NewsController', ['except' => ['destroy'], 'as' => 'admin']);
    Route::get('news/{id}/delete', ['as' => 'admin.news.delete', 'uses' => 'NewsController@destroy']);
    Route::patch('news/{id}/deleteImage', ['as' => 'admin.news.deleteImage', 'uses' => 'NewsController@deleteImage']);
});