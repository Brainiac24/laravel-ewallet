<?php

// Home > coordinatepointServices
Breadcrumbs::register('admin.coordinatepointServices.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('coordinatePointService.backend.title'), route('admin.coordinatepointServices.index'));
});
// Home > coordinatepointServices > Create
Breadcrumbs::register('admin.coordinatepointServices.create', function($breadcrumbs) {
    $breadcrumbs->parent('admin.coordinatepointServices.index');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.coordinatepointServices.index'));
});
// Home > coordinatepointServices > edit
Breadcrumbs::register('admin.coordinatepointServices.edit', function($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.coordinatepointServices.index');
    $breadcrumbs->push(isset($object->name) ? $object->name : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), '');
});
// Home > coordinatepointServices > show
Breadcrumbs::register('admin.coordinatepointServices.show', function($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.coordinatepointServices.index');
    $breadcrumbs->push(isset($object->name) ? $object->name : '', '');
    $breadcrumbs->push(trans('actions.general.view'), '');
});