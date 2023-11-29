<?php

Breadcrumbs::register('admin.order.orderAccountTypeItem.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('orderAccountTypeItem.backend.title'), route('admin.order.orderAccountTypeItem.index'));
});

Breadcrumbs::register('admin.order.orderAccountTypeItem.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.order.orderAccountTypeItem.index');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.order.orderAccountTypeItem.index'));
});
//
Breadcrumbs::register('admin.order.orderAccountTypeItem.show', function ($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.order.orderAccountTypeItem.index');
    $breadcrumbs->push(isset($object->name) ? $object->name : '', '');
    $breadcrumbs->push(trans('actions.general.view'), route('admin.order.orderAccountTypeItem.index'));
});
//
Breadcrumbs::register('admin.order.orderAccountTypeItem.edit', function ($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.order.orderAccountTypeItem.index');
    $breadcrumbs->push(isset($object->name) ? $object->name : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), route('admin.order.orderAccountTypeItem.index'));
});