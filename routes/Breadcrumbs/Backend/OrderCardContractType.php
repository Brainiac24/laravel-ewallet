<?php
Breadcrumbs::register('admin.order.cardContractType.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('orderCardContractType.backend.title'), route('admin.order.cardContractType.index'));
});

Breadcrumbs::register('admin.order.cardContractType.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.order.cardContractType.index');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.order.cardContractType.index'));
});

Breadcrumbs::register('admin.order.cardContractType.edit', function ($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.order.cardContractType.index');
    $breadcrumbs->push(isset($object) ? $object : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), route('admin.order.cardContractType.index'));
});