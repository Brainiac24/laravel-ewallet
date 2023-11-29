<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2017
 * Time: 12:00
 */

// Home > transactionHistory
Breadcrumbs::register('admin.transactions.histories.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('transactionHistory.backend.title'), route('admin.transactions.histories.index'));
});
// Home > transactionHistory > Create
Breadcrumbs::register('admin.transactions.histories.create', function($breadcrumbs) {
    $breadcrumbs->parent('admin.transactions.histories.index');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.transactions.histories.index'));
});
// Home > transactionHistory > Edit
Breadcrumbs::register('admin.transactions.histories.edit', function($breadcrumbs, $role) {
    $breadcrumbs->parent('admin.transactions.histories.index');
    $breadcrumbs->push(isset($role->name) ? $role->name : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), '');
});
// Home > transactionHistory > Show
Breadcrumbs::register('admin.transactions.histories.show', function($breadcrumbs, $role) {
    $breadcrumbs->parent('admin.transactions.histories.index');
    $breadcrumbs->push(isset($role->id) ? $role->id : '', '');
    $breadcrumbs->push(trans('actions.general.view'), '');
});