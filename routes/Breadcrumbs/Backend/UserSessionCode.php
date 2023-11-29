<?php

Breadcrumbs::register('admin.users.userSessionCode.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('userSessionCode.backend.title'), route('admin.users.userSessionCode.index'));
});

Breadcrumbs::register('admin.users.userSessionCode.show', function ($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.users.userSessionCode.index');
    $breadcrumbs->push(isset($object->value) ? $object->value : '', '');
    $breadcrumbs->push(trans('actions.general.view'), route('admin.users.userSessionCode.index'));
});
