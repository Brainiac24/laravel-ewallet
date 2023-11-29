<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2017
 * Time: 12:00
 */


Breadcrumbs::register('admin.currencies.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('currency.backend.title'), route('admin.currencies.index'));
});

Breadcrumbs::register('admin.currencies.create', function($breadcrumbs) {
    $breadcrumbs->parent('admin.currencies.index');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.currencies.index'));
});

Breadcrumbs::register('admin.currencies.show', function($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.currencies.index');
    $breadcrumbs->push(isset($object->name) ? $object->name : '', '');
    $breadcrumbs->push(trans('actions.general.view'), route('admin.currencies.index'));
});

Breadcrumbs::register('admin.currencies.edit', function($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.currencies.index');
    $breadcrumbs->push(isset($object->name) ? $object->name : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), '');
});