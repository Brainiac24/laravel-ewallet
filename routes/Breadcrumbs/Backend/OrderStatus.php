<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2017
 * Time: 12:00
 */

Breadcrumbs::register('admin.order.orderStatus.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('order.backend.title'), route('admin.order.orderStatus.index'));
});

Breadcrumbs::register('admin.order.orderStatus.show', function ($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.order.orderStatus.index');
    $breadcrumbs->push(isset($object->name) ? $object->name : '', '');
    $breadcrumbs->push(trans('actions.general.view'), route('admin.order.orderStatus.index'));
});
