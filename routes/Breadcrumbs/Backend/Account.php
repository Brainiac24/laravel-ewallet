<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2017
 * Time: 12:00
 */


Breadcrumbs::register('admin.accounts.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('accounts.backend.accounts'), route('admin.accounts.index'));
});

Breadcrumbs::register('admin.accounts.create', function($breadcrumbs) {
    $breadcrumbs->parent('admin.accounts.index');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.accounts.index'));
});

Breadcrumbs::register('admin.accounts.show', function($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.accounts.index');
    $breadcrumbs->push(isset($object->number) ? $object->number : '', '');
    $breadcrumbs->push(trans('actions.general.view'), route('admin.accounts.index'));
});

Breadcrumbs::register('admin.accounts.edit', function($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.accounts.index');
    $breadcrumbs->push(isset($object->name) ? $object->name : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), '');
});