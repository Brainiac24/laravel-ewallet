<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2017
 * Time: 12:00
 */

// Home > Users
Breadcrumbs::register('admin.users.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('users.backend.title'), route('admin.users.index'));
});

Breadcrumbs::register('admin.users.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.users.index');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.users.index'));
});

Breadcrumbs::register('admin.users.show', function ($breadcrumbs, $user) {
    $breadcrumbs->parent('admin.users.index');
    !is_object($user) ?: $breadcrumbs->push(isset($user->full_name) ? $user->username : '', '');
    $breadcrumbs->push(trans('actions.general.view'), route('admin.users.index'));
});

Breadcrumbs::register('admin.users.edit', function ($breadcrumbs, $user) {
    $breadcrumbs->parent('admin.users.index');
    !is_object($user) ?: $breadcrumbs->push(isset($user->full_name) ? $user->username : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), route('admin.users.index'));
});