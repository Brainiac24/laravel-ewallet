<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2017
 * Time: 12:00
 */

Breadcrumbs::register('admin.orders.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('order.backend.title'), route('admin.orders.index'));
});

Breadcrumbs::register('admin.orders.show', function ($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.orders.index');
    $breadcrumbs->push(isset($object->from_user->username) ? $object->from_user->username : '', '');
    $breadcrumbs->push(trans('actions.general.view'), route('admin.orders.index'));
});

Breadcrumbs::register('admin.orders.edit', function($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.orders.index');
    $breadcrumbs->push(isset($object->id) ? $object->id : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), '');
});