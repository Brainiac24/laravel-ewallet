<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2017
 * Time: 12:00
 */

Breadcrumbs::register('admin.cashbacks.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('cashback.backend.title'), route('admin.cashbacks.index'));
});

Breadcrumbs::register('admin.cashbacks.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.cashbacks.index');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.cashbacks.index'));
});
//
Breadcrumbs::register('admin.cashbacks.show', function ($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.cashbacks.index');
    $breadcrumbs->push(isset($object->name) ? $object->name : '', '');
    $breadcrumbs->push(trans('actions.general.view'), route('admin.cashbacks.index'));
});
//
Breadcrumbs::register('admin.cashbacks.edit', function ($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.cashbacks.index');
    $breadcrumbs->push(isset($object->name) ? $object->name : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), '');
});