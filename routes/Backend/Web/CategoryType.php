<?php

#CRUD Point #1

Route::group(['namespace' => 'CategoryType'], function () {

    Route::resource('categoryTypes', 'CategoryTypeController', ['except' => ['destroy'], 'as' => 'admin']);
});