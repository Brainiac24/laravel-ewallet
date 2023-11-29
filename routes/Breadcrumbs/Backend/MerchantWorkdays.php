<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 17.12.2019
 * Time: 11:28
 */

// Home > transactionStatus
Breadcrumbs::register('admin.merchants.merchantWorkdays.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('merchantWorkdays.backend.title'), route('admin.merchants.merchantWorkdays.index'));
});
// Home > transactionStatus > Create
Breadcrumbs::register('admin.merchants.merchantWorkdays.create', function($breadcrumbs) {
    $breadcrumbs->parent('admin.merchants.merchantWorkdays.index');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.merchants.merchantWorkdays.index'));
});

Breadcrumbs::register('admin.merchants.merchantWorkdays.edit', function($breadcrumbs, $role) {
    $breadcrumbs->parent('admin.merchants.merchantWorkdays.index');
    $breadcrumbs->push(isset($role->name) ? $role->name : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), '');
});

Breadcrumbs::register('admin.merchants.merchantWorkdays.show', function($breadcrumbs, $role) {
    $breadcrumbs->parent('admin.merchants.merchantWorkdays.index');
    $breadcrumbs->push(isset($role->name) ? $role->name : '', '');
    $breadcrumbs->push(trans('actions.general.view'), '');
});