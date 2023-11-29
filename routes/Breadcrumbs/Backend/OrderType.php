<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2017
 * Time: 12:00
 */

Breadcrumbs::register('admin.order.orderType.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('order.backend.title'), route('admin.order.orderType.index'));
});

Breadcrumbs::register('admin.order.orderType.show', function ($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.order.orderType.index');
    $breadcrumbs->push(isset($object->name) ? $object->name : '', '');
    $breadcrumbs->push(trans('actions.general.view'), route('admin.order.orderType.index'));
});
