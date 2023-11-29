<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2017
 * Time: 12:00
 */

// Home > Roles
Breadcrumbs::register('admin.coordinatepoints.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('coordinatePoint.backend.title'), route('admin.coordinatepoints.index'));
});
// Home > Roles > Create
Breadcrumbs::register('admin.coordinatepoints.create', function($breadcrumbs) {
    $breadcrumbs->parent('admin.coordinatepoints.index');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.coordinatepoints.index'));
});
// Home > Roles > Edit
Breadcrumbs::register('admin.coordinatepoints.edit', function($breadcrumbs) {
    $breadcrumbs->parent('admin.coordinatepoints.index');
    //$breadcrumbs->push(isset($role->name) ? $role->name : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), '');
});
// Home > Roles > Show
Breadcrumbs::register('admin.coordinatepoints.show', function($breadcrumbs) {
    $breadcrumbs->parent('admin.coordinatepoints.index');
//    $breadcrumbs->push(isset($role->name) ? $role->name : '', '');
    $breadcrumbs->push(trans('actions.general.view'), '');
});

Breadcrumbs::register('admin.coordinatepoints.store', function($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    //$breadcrumbs->push(isset($license) ? $license : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), '');
});

Breadcrumbs::register('admin.coordinatepoints.delete', function($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    //$breadcrumbs->push(isset($license) ? $license : '', '');
    $breadcrumbs->push(trans('actions.general.delete'), '');
});