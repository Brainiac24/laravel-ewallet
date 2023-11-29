<?php
Breadcrumbs::register('admin.DwhRule.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('dwhRule.backend.title'), route('admin.DwhRule.index'));
});

Breadcrumbs::register('admin.DwhRule.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.DwhRule.index');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.DwhRule.index'));
});
//
Breadcrumbs::register('admin.DwhRule.show', function ($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.DwhRule.index');
    $breadcrumbs->push(isset($object->name) ? $object->name : '', '');
    $breadcrumbs->push(trans('actions.general.view'), route('admin.DwhRule.index'));
});
//
Breadcrumbs::register('admin.DwhRule.edit', function ($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.DwhRule.index');
    $breadcrumbs->push(isset($object->id) ? $object->id : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), '');
});