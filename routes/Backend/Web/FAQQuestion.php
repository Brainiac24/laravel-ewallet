<?php

Route::group(['namespace' => 'FAQ\FAQQuestion'], function () {

    Route::resource('FAQQuestions', 'FAQQuestionController', ['except' => ['destroy'], 'as' => 'admin']);
    Route::get('FAQQuestions/{id}/delete', ['as' => 'admin.FAQQuestions.delete', 'uses' => 'FAQQuestionController@destroy']);
});