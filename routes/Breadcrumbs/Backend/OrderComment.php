<?php

Breadcrumbs::register('admin.order.orderComment.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('orderComment.backend.title'), route('admin.order.orderComment.index'));
});

Breadcrumbs::register('admin.order.orderComment.create', function($breadcrumbs) {
    $breadcrumbs->parent('admin.order.orderComment.index');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.order.orderComment.index'));
});

Breadcrumbs::register('admin.order.orderComment.edit', function($breadcrumbs) {
    $breadcrumbs->parent('admin.order.orderComment.index');
    $breadcrumbs->push(trans('actions.general.edit'), route('admin.order.orderComment.index'));
});

Breadcrumbs::register('admin.order.orderComment.show', function ($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.order.orderComment.index');
    $breadcrumbs->push(isset($object->name) ? $object->name : '', '');
    $breadcrumbs->push(trans('actions.general.view'), route('admin.order.orderComment.index'));
});
