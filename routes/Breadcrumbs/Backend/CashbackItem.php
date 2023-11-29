<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 01.11.2019
 * Time: 10:36
 */

Breadcrumbs::register('admin.cashback.items.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('cashbackItem.backend.title'), route('admin.cashback.items.index'));
});
// Home > transactionStatus > Create
Breadcrumbs::register('admin.cashback.items.create', function ($cashback_id,$breadcrumbs) {
//    $breadcrumbs->parent('admin.cashback.items.index', $cashback_id);
//    $breadcrumbs->push(trans('actions.general.create'), route('admin.cashback.items.index'));
});
//
Breadcrumbs::register('admin.cashback.items.edit', function ($breadcrumbs, $cashback_id, $object) {
    //$breadcrumbs->parent('admin.cashback.items.index');
    $breadcrumbs->parent('admin.cashbacks.edit',$object);
    $breadcrumbs->push(isset($object->name) ? $object->name : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), route('admin.cashbacks.edit',['id'=>$cashback_id]));
});
//
Breadcrumbs::register('admin.cashback.items.show', function ($breadcrumbs, $cashback_id,$object) {
    $breadcrumbs->parent('admin.cashbacks.show',$object);
    $breadcrumbs->push(isset($object->name) ? $object->name : '', '');
    $breadcrumbs->push(trans('actions.general.view'), route('admin.cashbacks.show',['id'=>$cashback_id]));
});