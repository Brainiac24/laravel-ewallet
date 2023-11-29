<?php

// Home > FAQQuestions
Breadcrumbs::register('admin.FAQQuestions.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('faqQuestion.backend.title'), route('admin.FAQQuestions.index'));
});
// Home > FAQQuestions > Create
Breadcrumbs::register('admin.FAQQuestions.create', function($breadcrumbs) {
    $breadcrumbs->parent('admin.FAQQuestions.index');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.FAQQuestions.index'));
});
// Home > FAQQuestions > edit
Breadcrumbs::register('admin.FAQQuestions.edit', function($breadcrumbs) {
    $breadcrumbs->parent('admin.FAQQuestions.index');
    $breadcrumbs->push(trans('actions.general.edit'), '');
});
// Home > FAQQuestions > Show
Breadcrumbs::register('admin.FAQQuestions.show', function($breadcrumbs) {
    $breadcrumbs->parent('admin.FAQQuestions.index');
    $breadcrumbs->push(trans('actions.general.view'), '');
});