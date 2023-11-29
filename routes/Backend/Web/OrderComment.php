<?php
Route::group(['namespace' => 'Order\OrderComment'], function () {
    Route::resource('orderComment', 'OrderCommentController', ['except' => ['destroy'], 'as' => 'admin.order']);
});