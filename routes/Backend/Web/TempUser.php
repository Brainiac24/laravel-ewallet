<?php

#CRUD Point #1

Route::group(['namespace' => 'User\TempUser'], function () {

    Route::resource('users/tempUsers', 'TempUsersController', ['except' => ['destroy','create','update','store','edit'], 'as' => 'admin.users']);
});