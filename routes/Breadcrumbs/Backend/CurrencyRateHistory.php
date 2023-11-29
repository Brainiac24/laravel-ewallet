<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2017
 * Time: 12:00
 */


Breadcrumbs::register('admin.currencies.rates.histories.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('currencyRateHistory.backend.title'), route('admin.currencies.rates.histories.index'));
});

Breadcrumbs::register('admin.currencies.rates.histories.create', function($breadcrumbs) {
    $breadcrumbs->parent('admin.currencies.rates.histories.index');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.currencies.rates.histories.index'));
});

Breadcrumbs::register('admin.currencies.rates.histories.show', function($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.currencies.rates.histories.index');
    $breadcrumbs->push(isset($object->currency_id) ? $object->currency_id : '', '');
    $breadcrumbs->push(trans('actions.general.view'), route('admin.currencies.rates.histories.index'));
});

Breadcrumbs::register('admin.currencies.rates.histories.edit', function($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.currencies.rates.histories.index');
    $breadcrumbs->push(isset($object->currency_id) ? $object->currency_id : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), '');
});