<?php

Breadcrumbs::register('admin.jobHistory.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('jobHistory.backend.title'), route('admin.jobHistory.index'));
});
Breadcrumbs::register('admin.job.jobHistory.command', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('jobHistory.backend.title'), route('admin.jobHistory.index'));
});
Breadcrumbs::register('admin.jobHistory.show', function ($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.jobHistory.index');
    $breadcrumbs->push(isset($object->id) ? $object->id : '', '');
    $breadcrumbs->push(trans('actions.general.view'), route('admin.jobHistory.index'));
});