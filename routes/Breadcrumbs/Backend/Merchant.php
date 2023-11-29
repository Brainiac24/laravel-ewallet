<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 01.11.2019
 * Time: 10:35
 */

Breadcrumbs::register('admin.merchants.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('merchant.backend.title'), route('admin.merchants.index'));
});

Breadcrumbs::register('admin.merchants.create', function($breadcrumbs) {
    $breadcrumbs->parent('admin.merchants.index');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.merchants.index'));
});

Breadcrumbs::register('admin.merchants.show', function($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.merchants.index');
    $breadcrumbs->push(isset($object->name) ? $object->name : '', '');
    $breadcrumbs->push(trans('actions.general.view'), route('admin.merchants.index'));
});

Breadcrumbs::register('admin.merchants.edit', function($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.merchants.index');
    $breadcrumbs->push(isset($object->name) ? $object->name : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), '');
});