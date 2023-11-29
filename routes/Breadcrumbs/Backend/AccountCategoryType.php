<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2017
 * Time: 12:00
 */

// Home > transactionStatus
Breadcrumbs::register('admin.accounts.category.types.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('accountType.backend.title'), route('admin.accounts.category.types.index'));
});
// Home > transactionStatus > Create
Breadcrumbs::register('admin.accounts.category.types.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.accounts.category.types.index');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.accounts.category.types.index'));
});
//
Breadcrumbs::register('admin.accounts.category.types.edit', function ($breadcrumbs, $role) {
    $breadcrumbs->parent('admin.accounts.category.types.index');
    $breadcrumbs->push(isset($role->name) ? $role->name : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), '');
});
//
Breadcrumbs::register('admin.accounts.category.types.show', function ($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.accounts.category.types.index');
    $breadcrumbs->push(isset($object->id) ? $object->id : '', '');
    $breadcrumbs->push(trans('actions.general.view'), route('admin.accounts.category.types.index'));
});