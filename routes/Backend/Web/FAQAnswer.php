<?php

Route::group(['namespace' => 'FAQ\FAQAnswer'], function () {

    Route::resource('FAQQuestions/{FAQQuestion_id}/FAQAnswers', 'FAQAnswerController', ['except' => ['destroy'], 'as' => 'admin.FAQQuestions']);
    Route::get('FAQQuestions/{FAQQuestion_id}/FAQAnswers/{id}/delete', ['as' => 'admin.FAQQuestions.FAQAnswers.delete', 'uses' => 'FAQAnswerController@destroy']);
    Route::post('FAQQuestions/{FAQQuestion_id}/FAQAnswers/upload', ['as' => 'admin.FAQQuestions.FAQAnswers.upload', 'uses' => 'FAQAnswerController@upload']);
});