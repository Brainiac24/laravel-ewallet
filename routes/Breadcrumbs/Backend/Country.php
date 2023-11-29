<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2017
 * Time: 12:00
 */

Breadcrumbs::register('admin.countries.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('country.backend.title'), route('admin.countries.index'));
});

Breadcrumbs::register('admin.countries.create', function($breadcrumbs) {
    $breadcrumbs->parent('admin.countries.index');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.countries.index'));
});

Breadcrumbs::register('admin.countries.show', function($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.countries.index');
    $breadcrumbs->push(isset($object->name) ? $object->name : '', '');
    $breadcrumbs->push(trans('actions.general.view'), route('admin.countries.index'));
});

Breadcrumbs::register('admin.countries.edit', function($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.countries.index');
    $breadcrumbs->push(isset($object->name) ? $object->name : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), '');
});