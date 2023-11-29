<?php

Breadcrumbs::register('admin.order.orderAccountType.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('orderAccountType.backend.title'), route('admin.order.orderAccountType.index'));
});

Breadcrumbs::register('admin.order.orderAccountType.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.order.orderAccountType.index');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.order.orderAccountType.index'));
});
//
Breadcrumbs::register('admin.order.orderAccountType.show', function ($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.order.orderAccountType.index');
    $breadcrumbs->push(isset($object->name) ? $object->name : '', '');
    $breadcrumbs->push(trans('actions.general.view'), route('admin.order.orderAccountType.index'));
});
//
Breadcrumbs::register('admin.order.orderAccountType.edit', function ($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.order.orderAccountType.index');
    $breadcrumbs->push(isset($object->name) ? $object->name : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), route('admin.order.orderAccountType.index'));
});