<?php

Breadcrumbs::register('admin.merchants.users.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('merchantUser.backend.title'), route('admin.merchants.users.index'));
});
//
Breadcrumbs::register('admin.merchants.users.edit', function ($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.merchants.users.index');
    $breadcrumbs->push(isset($object->id)?$object->id:'','');
    $breadcrumbs->push(trans('actions.general.edit'),'');
});
//
Breadcrumbs::register('admin.merchants.users.show', function ($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.merchants.users.index');
    $breadcrumbs->push(isset($object->id)?$object->id:'','');
    $breadcrumbs->push(trans('actions.general.view'),'');
});