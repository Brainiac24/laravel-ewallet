<?php

Route::group(['namespace' => 'Report\ReportAnalysis'], function(){

    Route::resource('reports/report_analysis', 'ReportAnalysisController', ['except' => ['destroy', 'show'], 'as' => 'admin']);
    Route::get('reports/report_analysis/{id}/delete', ['as' => 'admin.report_analysis.delete', 'uses' => 'ReportAnalysisController@destroy']);

});

