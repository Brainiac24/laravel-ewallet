<?php

Breadcrumbs::register('admin.transactions.continueRules.accordance.index', function($breadcrumbs) {
//    $breadcrumbs->parent('admin.dashboard');
//    $breadcrumbs->push(trans('transactionContinueRule.backend.title'), route('admin.transactions.continueRules.index'));
});
Breadcrumbs::register('admin.transactions.continueRules.accordance.create', function($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.transactions.continueRules.show', $object);
    $breadcrumbs->push(trans('transactionContinueRuleAccordance.backend.title'), '');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.transactions.continueRules.show', $object->id));
});

Breadcrumbs::register('admin.transactions.continueRules.accordance.edit', function($breadcrumbs, $object, $id) {
    $breadcrumbs->parent('admin.transactions.continueRules.show', $object);
    $breadcrumbs->push(trans('transactionContinueRuleAccordance.backend.title'), '');
    $breadcrumbs->push(trans('actions.general.edit'), route('admin.transactions.continueRules.show', $object->id));
});

Breadcrumbs::register('admin.transactions.continueRules.accordance.show', function($breadcrumbs, $object, $id) {
    $breadcrumbs->parent('admin.transactions.continueRules.show', $object);
    $breadcrumbs->push(trans('transactionContinueRuleAccordance.backend.title'), '');
    $breadcrumbs->push(trans('actions.general.view'), '');
});