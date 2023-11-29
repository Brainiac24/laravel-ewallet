<?php

#CRUD Point #1

Route::group(['namespace' => 'Report'], function () {

    Route::resource('reportMerchant', 'MerchantController', ['only' => ['index'], 'as' => 'admin']);

});

