<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2017
 * Time: 12:00
 */

// Home > commission.data
Breadcrumbs::register('admin.services.commissions.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('commission.backend.title'), route('admin.services.commissions.index'));
});
// Home > commission.data > Create
Breadcrumbs::register('admin.services.commissions.create', function($breadcrumbs) {
    $breadcrumbs->parent('admin.services.commissions.index');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.services.commissions.index'));
});
// Home > commission.data > edit
Breadcrumbs::register('admin.services.commissions.edit', function($breadcrumbs, $role) {
    $breadcrumbs->parent('admin.services.commissions.index');
    $breadcrumbs->push(isset($role->name) ? $role->name : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), '');
});
// Home > commission.data > show
Breadcrumbs::register('admin.services.commissions.show', function($breadcrumbs, $role) {
    $breadcrumbs->parent('admin.services.commissions.index');
    $breadcrumbs->push(isset($role->name) ? $role->name : '', '');
    $breadcrumbs->push(trans('actions.general.view'), '');
});