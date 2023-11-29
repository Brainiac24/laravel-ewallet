<?php

Breadcrumbs::register('admin.scheduleTypes.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('scheduleType.backend.title'), route('admin.scheduleTypes.index'));
});

Breadcrumbs::register('admin.scheduleTypes.show', function($breadcrumbs, $data) {
    $breadcrumbs->parent('admin.scheduleTypes.index');
    $breadcrumbs->push(isset($data->name) ? $data->name : '', '');
    $breadcrumbs->push(trans('actions.general.view'), '');
});