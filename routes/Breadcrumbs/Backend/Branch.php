<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2017
 * Time: 12:00
 */

Breadcrumbs::register('admin.branches.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('branch.backend.title'), route('admin.branches.index'));
});

Breadcrumbs::register('admin.branches.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.branches.index');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.branches.index'));
});
//
Breadcrumbs::register('admin.branches.show', function ($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.branches.index');
    $breadcrumbs->push(isset($object->name) ? $object->name : '', '');
    $breadcrumbs->push(trans('actions.general.view'), route('admin.branches.index'));
});
//
Breadcrumbs::register('admin.branches.edit', function ($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.branches.index');
    $breadcrumbs->push(isset($object->name) ? $object->name : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), '');
});