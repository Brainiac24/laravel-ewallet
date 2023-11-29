<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2017
 * Time: 12:00
 */

Breadcrumbs::register('admin.regions.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('region.backend.title'), route('admin.regions.index'));
});

Breadcrumbs::register('admin.regions.create', function($breadcrumbs) {
    $breadcrumbs->parent('admin.regions.index');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.regions.index'));
});

Breadcrumbs::register('admin.regions.show', function($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.regions.index');
    $breadcrumbs->push(isset($object->name) ? $object->name : '', '');
    $breadcrumbs->push(trans('actions.general.view'), route('admin.regions.index'));
});

Breadcrumbs::register('admin.regions.edit', function($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.regions.index');
    $breadcrumbs->push(isset($object->name) ? $object->name : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), '');
});