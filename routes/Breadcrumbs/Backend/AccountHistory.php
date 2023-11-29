<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2017
 * Time: 12:00
 */

// Home > transactionStatus
Breadcrumbs::register('admin.accounts.histories.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('accountHistory.backend.title'), route('admin.accounts.histories.index'));
});
// Home > transactionStatus > Create
Breadcrumbs::register('admin.accounts.histories.create', function($breadcrumbs) {
    $breadcrumbs->parent('admin.accounts.histories.index');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.accounts.histories.index'));
});

Breadcrumbs::register('admin.accounts.histories.edit', function($breadcrumbs, $role) {
    $breadcrumbs->parent('admin.accounts.histories.index');
    $breadcrumbs->push(isset($role->name) ? $role->name : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), '');
});

Breadcrumbs::register('admin.accounts.histories.show', function($breadcrumbs, $role) {
    $breadcrumbs->parent('admin.transactions.histories.index');
    $breadcrumbs->push(isset($role->number) ? $role->number : '', '');
    $breadcrumbs->push(trans('actions.general.view'), '');
});