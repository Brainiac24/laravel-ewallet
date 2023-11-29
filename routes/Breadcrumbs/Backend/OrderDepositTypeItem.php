<?php

Breadcrumbs::register('admin.order.orderDepositTypeItem.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('orderDepositTypeItem.backend.title'), route('admin.order.orderDepositTypeItem.index'));
});

Breadcrumbs::register('admin.order.orderDepositTypeItem.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.order.orderDepositTypeItem.index');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.order.orderDepositTypeItem.index'));
});
//
Breadcrumbs::register('admin.order.orderDepositTypeItem.show', function ($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.order.orderDepositTypeItem.index');
    $breadcrumbs->push(isset($object->name) ? $object->name : '', '');
    $breadcrumbs->push(trans('actions.general.view'), route('admin.order.orderDepositTypeItem.index'));
});
//
Breadcrumbs::register('admin.order.orderDepositTypeItem.edit', function ($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.order.orderDepositTypeItem.index');
    $breadcrumbs->push(isset($object->name) ? $object->name : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), route('admin.order.orderDepositTypeItem.index'));
});