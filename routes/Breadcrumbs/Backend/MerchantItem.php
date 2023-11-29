<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 01.11.2019
 * Time: 10:36
 */

Breadcrumbs::register('admin.merchants.items.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('merchantItem.backend.title'), route('admin.merchants.items.index'));
});
// Home > transactionStatus > Create
Breadcrumbs::register('admin.merchants.items.create', function ($merchant_id, $breadcrumbs) {
//    $breadcrumbs->parent('admin.merchants.items.index');
//    $breadcrumbs->push(trans('actions.general.create'), route('admin.merchants.items.index'));
});
//
Breadcrumbs::register('admin.merchants.items.edit', function ($breadcrumbs,$merchant_id,  $object) {
    //$breadcrumbs->parent('admin.merchants.items.index');
    $breadcrumbs->parent('admin.merchants.edit',$object);
    $breadcrumbs->push(isset($object->name) ? $object->name : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), route('admin.merchants.edit',['id'=>$merchant_id]));
});
//
Breadcrumbs::register('admin.merchants.items.show', function ($breadcrumbs,$merchant_id, $object) {
    $breadcrumbs->parent('admin.merchants.show', $object);
    $breadcrumbs->push(isset($object->id) ? $object->id : '', '');
    $breadcrumbs->push(trans('actions.general.view'), route('admin.merchants.show',['id'=>$merchant_id]));
});