<?php

Breadcrumbs::register('admin.order.orderCardType.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('orderCardType.backend.title'), route('admin.order.orderCardType.index'));
});

Breadcrumbs::register('admin.order.orderCardType.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.order.orderCardType.index');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.order.orderCardType.index'));
});
//
Breadcrumbs::register('admin.order.orderCardType.show', function ($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.order.orderCardType.index');
    $breadcrumbs->push(isset($object->name) ? $object->name : '', '');
    $breadcrumbs->push(trans('actions.general.view'), route('admin.order.orderCardType.index'));
});
//
Breadcrumbs::register('admin.order.orderCardType.edit', function ($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.order.orderCardType.index');
    $breadcrumbs->push(isset($object->name) ? $object->name : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), route('admin.order.orderCardType.index'));
});