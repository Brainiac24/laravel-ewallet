<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2017
 * Time: 12:00
 */

Breadcrumbs::register('admin.city.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('city.backend.title'), route('admin.city.index'));
});

Breadcrumbs::register('admin.city.create', function($breadcrumbs) {
    $breadcrumbs->parent('admin.city.index');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.city.index'));
});

Breadcrumbs::register('admin.city.show', function($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.city.index');
    $breadcrumbs->push(isset($object->name) ? $object->name : '', '');
    $breadcrumbs->push(trans('actions.general.view'), route('admin.city.index'));
});

Breadcrumbs::register('admin.city.edit', function($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.city.index');
    $breadcrumbs->push(isset($object->name) ? $object->name : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), '');
});