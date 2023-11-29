<?php

Breadcrumbs::register('admin.transactions.sync-status.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('transactionSyncStatus.backend.title'), route('admin.transactions.sync-status.index'));
});

Breadcrumbs::register('admin.transactions.sync-status.show', function ($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.transactions.sync-status.index');
    $breadcrumbs->push(isset($object->name) ? $object->name : '', '');
    $breadcrumbs->push(trans('actions.general.view'), route('admin.transactions.sync-status.index'));
});
