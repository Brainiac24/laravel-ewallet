<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2017
 * Time: 12:00
 */

// Home > categories
Breadcrumbs::register('admin.categories.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('category.backend.title'), route('admin.categories.index'));
});
// Home > categories > Create
Breadcrumbs::register('admin.categories.create', function($breadcrumbs) {
    $breadcrumbs->parent('admin.categories.index');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.categories.index'));
});
// Home > categories > edit
Breadcrumbs::register('admin.categories.edit', function($breadcrumbs, $role) {
    $breadcrumbs->parent('admin.categories.index');
    $breadcrumbs->push(isset($role->name) ? $role->name : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), '');
});
// Home > categories > Show
Breadcrumbs::register('admin.categories.show', function($breadcrumbs, $role) {
    $breadcrumbs->parent('admin.categories.index');
    $breadcrumbs->push(isset($role->name) ? $role->name : '', '');
    $breadcrumbs->push(trans('actions.general.view'), '');
});