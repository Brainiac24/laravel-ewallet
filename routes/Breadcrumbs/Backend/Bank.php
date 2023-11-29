<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2017
 * Time: 12:00
 */

Breadcrumbs::register('admin.banks.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('bank.backend.title'), route('admin.banks.index'));
});

Breadcrumbs::register('admin.banks.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.banks.index');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.banks.index'));
});
//
Breadcrumbs::register('admin.bank.show', function ($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.banks.index');
    $breadcrumbs->push(isset($object->name) ? $object->name : '', '');
    $breadcrumbs->push(trans('actions.general.view'), route('admin.banks.index'));
});
//
Breadcrumbs::register('admin.bank.edit', function ($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.banks.index');
    $breadcrumbs->push(isset($object->name) ? $object->name : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), '');
});