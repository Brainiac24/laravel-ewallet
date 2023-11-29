<?php

// Home > cashbackTypes
Breadcrumbs::register('admin.cashbackTypes.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('cashbackType.backend.title'), route('admin.cashbackTypes.index'));
});
// Home > cashbackTypes > Create
Breadcrumbs::register('admin.cashbackTypes.create', function($breadcrumbs) {
    $breadcrumbs->parent('admin.cashbackTypes.index');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.cashbackTypes.index'));
});
// Home > cashbackTypes > edit
Breadcrumbs::register('admin.cashbackTypes.edit', function($breadcrumbs, $cashbackType) {
    $breadcrumbs->parent('admin.cashbackTypes.index');
    $breadcrumbs->push(isset($cashbackType->name) ? $cashbackType->name : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), '');
});
// Home > cashbackTypes > Show
Breadcrumbs::register('admin.cashbackTypes.show', function($breadcrumbs, $cashbackType) {
    $breadcrumbs->parent('admin.cashbackTypes.index');
    $breadcrumbs->push(isset($cashbackType->name) ? $cashbackType->name : '', '');
    $breadcrumbs->push(trans('actions.general.view'), '');
});