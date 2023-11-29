<?php

// Home > coordinatepointTypes
Breadcrumbs::register('admin.coordinatePointCities.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('coordinatePointCity.backend.title'), route('admin.coordinatePointCities.index'));
});
// Home > coordinatepointTypes > Create
Breadcrumbs::register('admin.coordinatePointCities.create', function($breadcrumbs) {
    $breadcrumbs->parent('admin.coordinatePointCities.index');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.coordinatePointCities.index'));
});
// Home > coordinatepointTypes > edit
Breadcrumbs::register('admin.coordinatePointCities.edit', function($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.coordinatePointCities.index');
    $breadcrumbs->push(isset($object->name) ? $object->name : '', route('admin.coordinatePointCities.show',$object->id));
    $breadcrumbs->push(trans('actions.general.edit'), '');
});
// Home > coordinatepointTypes > show
Breadcrumbs::register('admin.coordinatePointCities.show', function($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.coordinatePointCities.index');
    $breadcrumbs->push(isset($object->name) ? $object->name : '', route('admin.coordinatePointCities.show',$object->id));
    $breadcrumbs->push(trans('actions.general.view'), '');
});