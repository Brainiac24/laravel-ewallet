<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2017
 * Time: 12:00
 */

// Home > transactionStatusDetail
Breadcrumbs::register('admin.transactions.status-detail.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('transactionStatusDetail.backend.title'), route('admin.transactions.status-detail.index'));
});
// Home > transactionStatusDetail > Create
Breadcrumbs::register('admin.transactions.status-detail.create', function($breadcrumbs) {
    $breadcrumbs->parent('admin.transactions.status-detail.index');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.transactions.status-detail.index'));
});

Breadcrumbs::register('admin.transactions.status-detail.edit', function($breadcrumbs, $role) {
    $breadcrumbs->parent('admin.transactions.status-detail.index');
    $breadcrumbs->push(isset($role->name) ? $role->name : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), '');
});

Breadcrumbs::register('admin.transactions.statusDetail.show', function($breadcrumbs, $role) {
    $breadcrumbs->parent('admin.transactions.status-detail.index');
    $breadcrumbs->push(isset($role->name) ? $role->name : '', '');
    $breadcrumbs->push(trans('actions.general.view'), '');
});