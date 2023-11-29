<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2017
 * Time: 12:00
 */

Breadcrumbs::register('admin.transactions.status-group.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('transactionStatusGroup.backend.title'), route('admin.transactions.status-group.index'));
});

Breadcrumbs::register('admin.transactions.status-group.show', function ($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.transactions.status-group.index');
    $breadcrumbs->push(isset($object->name) ? $object->name : '', '');
    $breadcrumbs->push(trans('actions.general.view'), route('admin.transactions.status-group.index'));
});
