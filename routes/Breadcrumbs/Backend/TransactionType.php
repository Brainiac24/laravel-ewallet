<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2017
 * Time: 12:00
 */

// Home > transactionStatus
Breadcrumbs::register('admin.transactions.type.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('transactionType.backend.title'), route('admin.transactions.type.index'));
});
// Home > transactionStatus > Create
Breadcrumbs::register('admin.transactions.type.create', function($breadcrumbs) {
    $breadcrumbs->parent('admin.transactions.type.index');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.transactions.type.index'));
});

Breadcrumbs::register('admin.transactions.type.edit', function($breadcrumbs, $role) {
    $breadcrumbs->parent('admin.transactions.type.index');
    $breadcrumbs->push(isset($role->name) ? $role->name : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), '');
});

Breadcrumbs::register('admin.transactions.type.show', function($breadcrumbs, $role) {
    $breadcrumbs->parent('admin.transactions.type.index');
    $breadcrumbs->push(isset($role->name) ? $role->name : '', '');
    $breadcrumbs->push(trans('actions.general.view'), '');
});