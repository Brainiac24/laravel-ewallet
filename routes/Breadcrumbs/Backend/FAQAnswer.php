<?php

// Home > FAQAnswers
Breadcrumbs::register('admin.FAQQuestions.FAQAnswers.index', function($breadcrumbs) {
//    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('faqAnswer.backend.title'),'');
});
// Home > FAQAnswers > Create
Breadcrumbs::register('admin.FAQQuestions.FAQAnswers.create', function($breadcrumbs) {
//    $breadcrumbs->parent('admin.FAQQuestions.FAQAnswers.index');
//    $breadcrumbs->push(trans('actions.general.create'), route('admin.FAQQuestions.FAQAnswers.index'));
});
// Home > FAQAnswers > edit
Breadcrumbs::register('admin.FAQQuestions.FAQAnswers.edit', function($breadcrumbs, $FAQQuestion_id) {
    $breadcrumbs->parent('admin.FAQQuestions.show');
    $breadcrumbs->parent('admin.FAQQuestions.FAQAnswers.index');
    $breadcrumbs->push(trans('actions.general.edit'), route('admin.FAQQuestions.edit',['id'=>$FAQQuestion_id]));
});
// Home > FAQAnswers > Show
Breadcrumbs::register('admin.FAQQuestions.FAQAnswers.show', function($breadcrumbs, $FAQQuestion_id) {
    $breadcrumbs->parent('admin.FAQQuestions.show');
    $breadcrumbs->parent('admin.FAQQuestions.FAQAnswers.index');
    $breadcrumbs->push(trans('actions.general.view'), route('admin.FAQQuestions.show',['id'=>$FAQQuestion_id]));
});