<?php

Breadcrumbs::register('admin.merchants.commission.items.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('merchantCommissionItem.backend.title'), route('admin.merchants.commission.items.index'));
});

Breadcrumbs::register('admin.merchants.commission.items.create', function($breadcrumbs) {
//    $breadcrumbs->parent('admin.merchants.commission.items.index');
//    $breadcrumbs->push(trans('actions.general.create'), route('admin.merchants.commission.items.index'));
});

Breadcrumbs::register('admin.merchants.commission.items.edit', function($breadcrumbs, $merchant_commission_id, $object) {
//    $breadcrumbs->parent('admin.merchants.commission.items.index');
    $breadcrumbs->parent('admin.merchants.commissions.edit',$object);
    $breadcrumbs->push(isset($object->name) ? $object->name : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), route('admin.merchants.commissions.edit',['id'=>$merchant_commission_id]));
});

Breadcrumbs::register('admin.merchants.commission.items.show', function($breadcrumbs,$merchant_commission_id, $object) {
    $breadcrumbs->parent('admin.merchants.commissions.show',$object);
    $breadcrumbs->push(isset($object->name) ? $object->name : '', '');
    $breadcrumbs->push(trans('actions.general.view'), route('admin.merchants.show',['id'=>$merchant_commission_id]));
});