<?php

Breadcrumbs::register('admin.purposes.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('purpose.backend.title'), route('admin.purposes.index'));
});

Breadcrumbs::register('admin.purposes.show', function ($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.purposes.index');
    $breadcrumbs->push(isset($object->name) ? $object->name : '', '');
    $breadcrumbs->push(trans('actions.general.view'), route('admin.purposes.index'));
});
