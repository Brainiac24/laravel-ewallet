<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2017
 * Time: 12:00
 */

// Home > transactionStatus
Breadcrumbs::register('admin.accounts.status.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('accountStatus.backend.title'), route('admin.accounts.status.index'));
});
// Home > transactionStatus > Create
Breadcrumbs::register('admin.accounts.status.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.accounts.status.index');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.accounts.status.index'));
});

Breadcrumbs::register('admin.accounts.status.edit', function ($breadcrumbs, $role) {
    $breadcrumbs->parent('admin.accounts.status.index');
    $breadcrumbs->push(isset($role->name) ? $role->name : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), '');
});

Breadcrumbs::register('admin.accounts.status.show', function ($breadcrumbs, $role) {
//    $breadcrumbs->parent('admin.transactions.type.index');
    $breadcrumbs->push(isset($role->name) ? $role->name : '', '');
    $breadcrumbs->push(trans('actions.general.view'), '');
});