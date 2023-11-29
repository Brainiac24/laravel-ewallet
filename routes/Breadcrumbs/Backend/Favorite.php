<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2017
 * Time: 12:00
 */

// Home > favorites
Breadcrumbs::register('admin.favorites.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('favorite.backend.title'), route('admin.favorites.index'));
});
// Home > favorites > Create
Breadcrumbs::register('admin.favorites.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.favorites.index');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.favorites.index'));
});
// Home > favorites > Edit
Breadcrumbs::register('admin.favorites.edit', function ($breadcrumbs, $role) {
    $breadcrumbs->parent('admin.favorites.index');
    $breadcrumbs->push(isset($role->name) ? $role->name : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), '');
});
// Home > favorites > Show
Breadcrumbs::register('admin.favorites.show', function ($breadcrumbs, $role) {
    $breadcrumbs->parent('admin.favorites.index');
    $breadcrumbs->push(isset($role->name) ? $role->name : '', '');
    $breadcrumbs->push(trans('actions.general.view'), '');
});