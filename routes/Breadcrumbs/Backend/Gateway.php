<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2017
 * Time: 12:00
 */

// Home > Roles
Breadcrumbs::register('admin.gateways.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('gateways.backend.title'), route('admin.gateways.index'));
});
// Home > Roles > Create
Breadcrumbs::register('admin.gateways.create', function($breadcrumbs) {
    $breadcrumbs->parent('admin.gateways.index');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.gateways.index'));
});

Breadcrumbs::register('admin.gateways.edit', function($breadcrumbs, $role) {
    $breadcrumbs->parent('admin.gateways.index');
    $breadcrumbs->push(isset($role->name) ? $role->name : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), '');
});

Breadcrumbs::register('admin.gateways.show', function($breadcrumbs, $role) {
    $breadcrumbs->parent('admin.gateways.index');
    $breadcrumbs->push(isset($role->name) ? $role->name : '', '');
    $breadcrumbs->push(trans('actions.general.view'), '');
});