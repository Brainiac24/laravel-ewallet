<?php

Breadcrumbs::register('admin.transferList.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('transferList.backend.title'), route('admin.transferList.index'));
});

Breadcrumbs::register('admin.transferList.show', function ($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.transferList.index');
    $breadcrumbs->push(isset($object->name) ? $object->name : '', '');
    $breadcrumbs->push(trans('actions.general.view'), route('admin.transferList.index'));
});


Breadcrumbs::register('admin.transferList.create', function($breadcrumbs) {
    $breadcrumbs->parent('admin.transferList.index');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.transferList.index'));
});

Breadcrumbs::register('admin.transferList.edit', function($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.transferList.index');
    $breadcrumbs->push(isset($object->name) ? $object->name : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), '');
});