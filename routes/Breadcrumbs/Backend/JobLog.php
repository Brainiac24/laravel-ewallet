<?php

Breadcrumbs::register('admin.jobLog.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('jobLog.backend.title'), route('admin.jobLog.index'));
});
Breadcrumbs::register('admin.jobLog.show', function ($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.jobLog.index');
    $breadcrumbs->push(isset($object->id) ? $object->id : '', '');
    $breadcrumbs->push(trans('actions.general.view'), route('admin.jobLog.index'));
});