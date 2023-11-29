<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2017
 * Time: 12:00
 */

// Home > Roles
Breadcrumbs::register('admin.roles.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('roles.backend.roles'), route('admin.roles.index'));
});
// Home > Roles > Create
Breadcrumbs::register('admin.roles.create', function($breadcrumbs) {
    $breadcrumbs->parent('admin.roles.index');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.roles.index'));
});

Breadcrumbs::register('admin.roles.edit', function($breadcrumbs, $role) {
    $breadcrumbs->parent('admin.roles.index');
    $breadcrumbs->push(isset($role->display_name) ? $role->display_name : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), '');
});

Breadcrumbs::register('admin.roles.show', function($breadcrumbs, $role) {
    $breadcrumbs->parent('admin.roles.index');
    $breadcrumbs->push(isset($role->display_name) ? $role->display_name : '', '');
    $breadcrumbs->push(trans('actions.general.view'), '');
});