<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2017
 * Time: 12:00
 */

Breadcrumbs::register('admin.areas.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('region.backend.title'), route('admin.areas.index'));
});

Breadcrumbs::register('admin.areas.create', function($breadcrumbs) {
    $breadcrumbs->parent('admin.areas.index');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.areas.index'));
});

Breadcrumbs::register('admin.areas.show', function($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.areas.index');
    $breadcrumbs->push(isset($object->name) ? $object->name : '', '');
    $breadcrumbs->push(trans('actions.general.view'), route('admin.areas.index'));
});

Breadcrumbs::register('admin.areas.edit', function($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.areas.index');
    $breadcrumbs->push(isset($object->name) ? $object->name : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), '');
});