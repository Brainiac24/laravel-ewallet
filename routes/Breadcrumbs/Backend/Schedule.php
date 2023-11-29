<?php

// Home > favorites
Breadcrumbs::register('admin.schedules.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('schedule.backend.title'), route('admin.schedules.index'));
});
// Home > favorites > Create
Breadcrumbs::register('admin.schedules.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.schedules.index');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.schedules.index'));
});
// Home > favorites > Edit
Breadcrumbs::register('admin.schedules.edit', function ($breadcrumbs, $data) {
    $breadcrumbs->parent('admin.schedules.index');
    $breadcrumbs->push(isset($data->name) ? $data->name : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), '');
});
// Home > favorites > Show
Breadcrumbs::register('admin.schedules.show', function ($breadcrumbs, $data) {
    $breadcrumbs->parent('admin.schedules.index');
    $breadcrumbs->push(isset($data->name) ? $data->name : '', '');
    $breadcrumbs->push(trans('actions.general.view'), '');
});