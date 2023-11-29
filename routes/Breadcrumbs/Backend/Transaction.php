<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2017
 * Time: 12:00
 */

// Home > transactions
Breadcrumbs::register('admin.transactions.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('transaction.backend.title'), route('admin.transactions.index'));
});
// Home > transactions > Create
Breadcrumbs::register('admin.transactions.create', function($breadcrumbs) {
    $breadcrumbs->parent('admin.transactions.index');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.transactions.index'));
});

Breadcrumbs::register('admin.transactions.child_index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.transactions.index');
    $breadcrumbs->push(trans('transaction.backend.child'), route('admin.transactions.index'));
});
// Home > transactions > Edit
Breadcrumbs::register('admin.transactions.edit', function($breadcrumbs, $role) {
    $breadcrumbs->parent('admin.transactions.index');
    $breadcrumbs->push(isset($role->id) ? $role->id : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), '');
});
// Home > transactions > Show
Breadcrumbs::register('admin.transactions.show', function($breadcrumbs, $role) {
    $breadcrumbs->parent('admin.transactions.index');
    $breadcrumbs->push(isset($role->id) ? $role->id : '', '');
    $breadcrumbs->push(trans('actions.general.view'), '');
});