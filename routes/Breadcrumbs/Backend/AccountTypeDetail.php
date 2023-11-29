<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2017
 * Time: 12:00
 */

// Home > transactionStatus
Breadcrumbs::register('admin.accounts.types-detail.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('accountTypeDetail.backend.title'), route('admin.accounts.types.index'));
});
// Home > transactionStatus > Create
Breadcrumbs::register('admin.accounts.types-detail.create', function($breadcrumbs) {
    $breadcrumbs->parent('admin.accounts.types-detail.index');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.accounts.types.index'));
});

Breadcrumbs::register('admin.accounts.types-detail.edit', function($breadcrumbs, $role) {
    $breadcrumbs->parent('admin.accounts.types-detail.index');
    $breadcrumbs->push(isset($role->name) ? $role->name : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), '');
});

Breadcrumbs::register('admin.accounts.types-detail.show', function($breadcrumbs, $role) {
    $breadcrumbs->parent('admin.transactions.type.index');
    $breadcrumbs->push(isset($role->name) ? $role->name : '', '');
    $breadcrumbs->push(trans('actions.general.view'), '');
});