<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2017
 * Time: 12:00
 */

// Home > Users
Breadcrumbs::register('admin.users.histories.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('userHistory.backend.title'), route('admin.users.histories.index'));
});

Breadcrumbs::register('admin.users.histories.create', function($breadcrumbs) {
    $breadcrumbs->parent('admin.users.histories.index');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.users.histories.index'));
});

Breadcrumbs::register('admin.users.histories.show', function($breadcrumbs, $user) {
    $breadcrumbs->parent('admin.users.histories.index');
    $breadcrumbs->push(isset($user->id) ? $user->id : '', '');
    $breadcrumbs->push(trans('actions.general.view'), route('admin.users.histories.index'));
});

Breadcrumbs::register('admin.users.histories.edit', function($breadcrumbs, $user) {
    $breadcrumbs->parent('admin.users.histories.index');
    $breadcrumbs->push(isset($user->id) ? $user->id : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), route('admin.users.histories.index'));
});