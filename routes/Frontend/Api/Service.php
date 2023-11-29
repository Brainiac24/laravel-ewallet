<?php

Route::group (['namespace' => 'Service'], function () {
    Route::get('services/{code}', ['as' => 'frontend.api.services', 'uses' => 'ServiceController@getServiceByid']);
});


