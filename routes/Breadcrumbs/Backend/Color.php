<?php

Breadcrumbs::register('admin.colors.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('color.backend.title'), route('admin.colors.index'));
});

Breadcrumbs::register('admin.colors.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.colors.index');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.colors.index'));
});
//
Breadcrumbs::register('admin.colors.show', function ($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.colors.index');
    $breadcrumbs->push(isset($object->color) ? $object->color : '', '');
    $breadcrumbs->push(trans('actions.general.view'), route('admin.colors.index'));
});
//
Breadcrumbs::register('admin.colors.edit', function ($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.colors.index');
    $breadcrumbs->push(isset($object->color) ? $object->color : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), '');
});