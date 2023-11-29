<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2017
 * Time: 12:00
 */

// Home > workdays
Breadcrumbs::register('admin.workdays.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('serviceworkdays.backend.workday'), route('admin.workdays.index'));
});
// Home > workdays > Create
Breadcrumbs::register('admin.workdays.create', function($breadcrumbs) {
    $breadcrumbs->parent('admin.workdays.index');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.workdays.index'));
});
// Home > workdays > edit
Breadcrumbs::register('admin.workdays.edit', function($breadcrumbs, $role) {
    $breadcrumbs->parent('admin.workdays.index');
    $breadcrumbs->push(isset($role->name) ? $role->name : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), '');
});
// Home > workdays > show
Breadcrumbs::register('admin.workdays.show', function($breadcrumbs, $role) {
    $breadcrumbs->parent('admin.workdays.index');
    $breadcrumbs->push(isset($role->name) ? $role->name : '', '');
    $breadcrumbs->push(trans('actions.general.view'), '');
});