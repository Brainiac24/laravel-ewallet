<?php

Route::group(['namespace' => 'User\UserHistory'], function(){

    Route::resource('users/histories', 'UserHistoryController', ['except' => ['destroy', 'edit','update','store','create'], 'as' => 'admin.users']);
});

