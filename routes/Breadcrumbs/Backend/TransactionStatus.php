<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2017
 * Time: 12:00
 */

// Home > transactionStatus
Breadcrumbs::register('admin.transactions.status.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('transactionStatus.backend.title'), route('admin.transactions.status.index'));
});
// Home > transactionStatus > Create
Breadcrumbs::register('admin.transactions.status.create', function($breadcrumbs) {
    $breadcrumbs->parent('admin.transactions.status.index');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.transactions.status.index'));
});

Breadcrumbs::register('admin.transactions.status.edit', function($breadcrumbs, $role) {
    $breadcrumbs->parent('admin.transactions.status.index');
    $breadcrumbs->push(isset($role->name) ? $role->name : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), '');
});

Breadcrumbs::register('admin.transactions.status.show', function($breadcrumbs, $role) {
    $breadcrumbs->parent('admin.transactions.status.index');
    $breadcrumbs->push(isset($role->name) ? $role->name : '', '');
    $breadcrumbs->push(trans('actions.general.view'), '');
});