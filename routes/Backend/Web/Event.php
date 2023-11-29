<?php

#CRUD Point #1

Route::group(['namespace' => 'User\Event'], function () {

    Route::resource('users/events', 'EventController', ['except' => ['destroy','create','update','store','edit'], 'as' => 'admin.users']);
});