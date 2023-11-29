<?php

Breadcrumbs::register('admin.users.unverifiedUser.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('unverifiedUser.backend.title'), route('admin.users.unverifiedUser.index'));
});

Breadcrumbs::register('admin.users.unverifiedUser.show', function ($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.users.unverifiedUser.index');
    $breadcrumbs->push(isset($object->msisdn) ? $object->msisdn : '', '');
    $breadcrumbs->push(trans('actions.general.view'), route('admin.users.unverifiedUser.index'));
});
