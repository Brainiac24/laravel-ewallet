<?php

Breadcrumbs::register('admin.remoteIdentification.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('remoteIdentification.backend.title'), route('admin.remoteIdentification.index'));
});

Breadcrumbs::register('admin.remoteIdentification.edit', function ($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.remoteIdentification.index');
    $breadcrumbs->push(isset($object->id) ? $object->id : '', '');
    $breadcrumbs->push(trans('actions.general.view'), route('admin.remoteIdentification.index'));
});


Breadcrumbs::register('admin.remoteIdentification.show', function ($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.remoteIdentification.index');
    $breadcrumbs->push(isset($object->id) ? $object->id : '', '');
    $breadcrumbs->push(trans('actions.general.view'), route('admin.remoteIdentification.index'));
});