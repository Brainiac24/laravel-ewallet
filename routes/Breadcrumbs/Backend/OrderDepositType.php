<?php

Breadcrumbs::register('admin.order.orderDepositType.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('orderDepositType.backend.title'), route('admin.order.orderDepositType.index'));
});

Breadcrumbs::register('admin.order.orderDepositType.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.order.orderDepositType.index');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.order.orderDepositType.index'));
});
//
Breadcrumbs::register('admin.order.orderDepositType.show', function ($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.order.orderDepositType.index');
    $breadcrumbs->push(isset($object->name) ? $object->name : '', '');
    $breadcrumbs->push(trans('actions.general.view'), route('admin.order.orderDepositType.index'));
});
//
Breadcrumbs::register('admin.order.orderDepositType.edit', function ($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.order.orderDepositType.index');
    $breadcrumbs->push(isset($object->name) ? $object->name : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), route('admin.order.orderDepositType.index'));
});