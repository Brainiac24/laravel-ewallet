<?php

Route::group(['namespace' => 'Purpose'], function () {

    Route::resource('purposes', 'PurposeController', ['except' => ['destroy','create','update','store','edit'], 'as' => 'admin']);
});