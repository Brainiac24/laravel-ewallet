<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2017
 * Time: 12:00
 */

// Home > transactionStatus
Breadcrumbs::register('admin.accounts.types.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('accountType.backend.title'), route('admin.accounts.types.index'));
});
// Home > transactionStatus > Create
Breadcrumbs::register('admin.accounts.types.create', function($breadcrumbs) {
    $breadcrumbs->parent('admin.accounts.types.index');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.accounts.types.index'));
});

Breadcrumbs::register('admin.accounts.types.edit', function($breadcrumbs, $role) {
    $breadcrumbs->parent('admin.accounts.types.index');
    $breadcrumbs->push(isset($role->name) ? $role->name : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), '');
});

Breadcrumbs::register('admin.accounts.types.show', function($breadcrumbs, $role) {
    $breadcrumbs->parent('admin.transactions.type.index');
    $breadcrumbs->push(isset($role->name) ? $role->name : '', '');
    $breadcrumbs->push(trans('actions.general.view'), '');
});