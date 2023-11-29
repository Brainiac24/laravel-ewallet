<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 17.12.2019
 * Time: 11:28
 */

// Home > transactionStatus
Breadcrumbs::register('admin.merchants.categories.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('merchantCategory.backend.title'), route('admin.merchants.categories.index'));
});
// Home > transactionStatus > Create
Breadcrumbs::register('admin.merchants.categories.create', function($breadcrumbs) {
    $breadcrumbs->parent('admin.merchants.categories.index');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.merchants.categories.index'));
});

Breadcrumbs::register('admin.merchants.categories.edit', function($breadcrumbs, $role) {
    $breadcrumbs->parent('admin.merchants.categories.index');
    $breadcrumbs->push(isset($role->name) ? $role->name : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), '');
});

Breadcrumbs::register('admin.merchants.categories.show', function($breadcrumbs, $role) {
    $breadcrumbs->parent('admin.merchants.categories.index');
    $breadcrumbs->push(isset($role->name) ? $role->name : '', '');
    $breadcrumbs->push(trans('actions.general.view'), '');
});