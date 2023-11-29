<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2017
 * Time: 12:00
 */

// Home > limits
Breadcrumbs::register('admin.limits.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('serviceLimits.backend.serviceLimit'), route('admin.limits.index'));
});
// Home > limits > Create
Breadcrumbs::register('admin.limits.create', function($breadcrumbs) {
    $breadcrumbs->parent('admin.limits.index');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.limits.index'));
});

Breadcrumbs::register('admin.limits.edit', function($breadcrumbs, $role) {
    $breadcrumbs->parent('admin.limits.index');
    $breadcrumbs->push(isset($role->name) ? $role->name : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), '');
});

Breadcrumbs::register('admin.limits.show', function($breadcrumbs, $role) {
    $breadcrumbs->parent('admin.limits.index');
    $breadcrumbs->push(isset($role->name) ? $role->name : '', '');
    $breadcrumbs->push(trans('actions.general.view'), '');
});