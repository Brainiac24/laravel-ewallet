<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2017
 * Time: 12:00
 */

// Home > services
Breadcrumbs::register('admin.services.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('service.backend.title'), route('admin.services.index'));
});
// Home > services > Create
Breadcrumbs::register('admin.services.create', function($breadcrumbs) {
    $breadcrumbs->parent('admin.services.index');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.services.index'));
});

Breadcrumbs::register('admin.services.edit', function($breadcrumbs, $role) {
    $breadcrumbs->parent('admin.services.index');
    $breadcrumbs->push(isset($role->name) ? $role->name : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), '');
});

Breadcrumbs::register('admin.services.show', function($breadcrumbs, $role) {
    $breadcrumbs->parent('admin.services.index');
    $breadcrumbs->push(isset($role->name) ? $role->name : '', '');
    $breadcrumbs->push(trans('actions.general.view'), '');
});