<?php

// Home > coordinatepointTypes
Breadcrumbs::register('admin.coordinatepointTypes.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('coordinatePointType.backend.title'), route('admin.coordinatepointTypes.index'));
});
// Home > coordinatepointTypes > Create
Breadcrumbs::register('admin.coordinatepointTypes.create', function($breadcrumbs) {
    $breadcrumbs->parent('admin.coordinatepointTypes.index');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.coordinatepointTypes.index'));
});
// Home > coordinatepointTypes > edit
Breadcrumbs::register('admin.coordinatepointTypes.edit', function($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.coordinatepointTypes.index');
    $breadcrumbs->push(isset($object->name) ? $object->name : '', route('admin.coordinatepointTypes.show',$object->id));
    $breadcrumbs->push(trans('actions.general.edit'), '');
});
// Home > coordinatepointTypes > show
Breadcrumbs::register('admin.coordinatepointTypes.show', function($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.coordinatepointTypes.index');
    $breadcrumbs->push(isset($object->name) ? $object->name : '', route('admin.coordinatepointTypes.show',$object->id));
    $breadcrumbs->push(trans('actions.general.view'), '');
});