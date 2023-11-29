<?php

Route::group (['namespace' => 'Favorite'], function () {
    Route::resource('favorites',  'FavoriteController');
});


