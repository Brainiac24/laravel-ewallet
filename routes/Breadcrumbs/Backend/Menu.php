<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2017
 * Time: 12:00
 */

// Home > menu
Breadcrumbs::register('admin.menu.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('menu.backend.title'), route('admin.menu.index'));
});
// Home > menu > Create
Breadcrumbs::register('admin.menu.create', function($breadcrumbs) {
    $breadcrumbs->parent('admin.menu.index');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.menu.index'));
});

Breadcrumbs::register('admin.menu.edit', function($breadcrumbs, $role) {
    $breadcrumbs->parent('admin.menu.index');
    $breadcrumbs->push(isset($role->name) ? $role->name : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), '');
});

Breadcrumbs::register('admin.menu.show', function($breadcrumbs, $role) {
    $breadcrumbs->parent('admin.menu.index');
    $breadcrumbs->push(isset($role->name) ? $role->name : '', '');
    $breadcrumbs->push(trans('actions.general.view'), '');
});