<?php

Breadcrumbs::register('admin.merchants.commissions.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('merchantCommission.backend.title'), route('admin.merchants.commissions.index'));
});

Breadcrumbs::register('admin.merchants.commissions.create', function($breadcrumbs) {
    $breadcrumbs->parent('admin.merchants.commissions.index');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.merchants.commissions.index'));
});

Breadcrumbs::register('admin.merchants.commissions.edit', function($breadcrumbs, $role) {
    $breadcrumbs->parent('admin.merchants.commissions.index');
    $breadcrumbs->push(isset($role->name) ? $role->name : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), '');
});

Breadcrumbs::register('admin.merchants.commissions.show', function($breadcrumbs, $role) {
    $breadcrumbs->parent('admin.merchants.commissions.index');
    $breadcrumbs->push(isset($role->name) ? $role->name : '', '');
    $breadcrumbs->push(trans('actions.general.view'), '');
});