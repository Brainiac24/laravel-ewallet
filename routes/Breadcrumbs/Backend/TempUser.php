<?php

Breadcrumbs::register('admin.users.tempUsers.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('tempUsers.backend.title'), route('admin.users.tempUsers.index'));
});

Breadcrumbs::register('admin.users.tempUsers.show', function ($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.users.tempUsers.index');
    $breadcrumbs->push(isset($object->code_map) ? $object->code_map : '', '');
    $breadcrumbs->push(trans('actions.general.view'), route('admin.users.tempUsers.index'));
});
