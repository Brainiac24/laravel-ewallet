<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2017
 * Time: 12:00
 */

// Home > Users
Breadcrumbs::register('admin.users.services.limits.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('userHistory.backend.title'), route('admin.users.services.limits.index'));
});

Breadcrumbs::register('admin.users.services.limits.create', function($breadcrumbs) {
    $breadcrumbs->parent('admin.users.services.limits.index');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.users.services.limits.index'));
});

Breadcrumbs::register('admin.users.services.limits.show', function($breadcrumbs, $user) {
    $breadcrumbs->parent('admin.users.services.limits.index');
    $breadcrumbs->push(isset($user->id) ? $user->id : '', '');
    $breadcrumbs->push(trans('actions.general.view'), route('admin.users.services.limits.index'));
});

Breadcrumbs::register('admin.users.services.limits.edit', function($breadcrumbs, $user) {
    $breadcrumbs->parent('admin.users.services.limits.index');
    $breadcrumbs->push(isset($user->id) ? $user->id : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), route('admin.users.services.limits.index'));
});