<?php

// Home > coordinatepointWorkdays
Breadcrumbs::register('admin.coordinatepointWorkdays.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('coordinatePointWorkday.backend.workday'), route('admin.coordinatepointWorkdays.index'));
});
// Home > coordinatepointWorkdays > Create
Breadcrumbs::register('admin.coordinatepointWorkdays.create', function($breadcrumbs) {
    $breadcrumbs->parent('admin.coordinatepointWorkdays.index');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.coordinatepointWorkdays.index'));
});
// Home > coordinatepointWorkdays > edit
Breadcrumbs::register('admin.coordinatepointWorkdays.edit', function($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.coordinatepointWorkdays.index');
    $breadcrumbs->push(isset($object->name) ? $object->name : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), '');
});
// Home > coordinatepointWorkdays > show
Breadcrumbs::register('admin.coordinatepointWorkdays.show', function($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.coordinatepointWorkdays.index');
    $breadcrumbs->push(isset($object->name) ? $object->name : '', '');
    $breadcrumbs->push(trans('actions.general.view'), '');
});