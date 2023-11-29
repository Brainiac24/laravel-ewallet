<?php

Breadcrumbs::register('admin.transactions.continueRules.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('transactionContinueRule.backend.title'), route('admin.transactions.continueRules.index'));
});
// Home > transactionStatus > Create
Breadcrumbs::register('admin.transactions.continueRules.create', function($breadcrumbs) {
    $breadcrumbs->parent('admin.transactions.continueRules.index');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.transactions.continueRules.index'));
});

Breadcrumbs::register('admin.transactions.continueRules.edit', function($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.transactions.continueRules.index');
    $breadcrumbs->push(isset($object->id) ? $object->id : '', route('admin.transactions.continueRules.show',$object->id));
    $breadcrumbs->push(trans('actions.general.edit'), '');
});

Breadcrumbs::register('admin.transactions.continueRules.show', function($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.transactions.continueRules.index');
    $breadcrumbs->push(isset($object->id) ? $object->id : '', route('admin.transactions.continueRules.show',$object->id));
    $breadcrumbs->push(trans('actions.general.view'), '');
});