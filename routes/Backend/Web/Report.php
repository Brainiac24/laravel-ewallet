<?php

Route::group(['namespace' => 'Report'], function () {
    Route::resource('reports', 'ReportController', ['only' => ['index'], 'as' => 'admin']);
    Route::get('reports/searchFileds', ['as' => 'admin.reports.searchFileds', 'uses' => 'ReportController@getSearchFileds']);
});

