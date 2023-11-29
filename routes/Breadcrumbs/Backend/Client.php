<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2017
 * Time: 12:00
 */


Breadcrumbs::register('admin.clients.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('client.backend.clients'), route('admin.clients.index'));
});

Breadcrumbs::register('admin.clients.create', function($breadcrumbs) {
    $breadcrumbs->parent('admin.clients.index');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.clients.index'));
});

Breadcrumbs::register('admin.clients.show', function($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.clients.index');
    $breadcrumbs->push(isset($object->msisdn) ? $object->msisdn : null, null);
    $breadcrumbs->push(trans('actions.general.view'), route('admin.clients.index'));
});

Breadcrumbs::register('admin.clients.edit', function($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.clients.index');
    $breadcrumbs->push(isset($object->msisdn) ? $object->msisdn : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), null);
});

Breadcrumbs::register('admin.clients.block', function($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.clients.index');
    $breadcrumbs->push(isset($object->msisdn) ? $object->msisdn : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), null);
});
Breadcrumbs::register('admin.clients.unblock', function($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.clients.index');
    $breadcrumbs->push(isset($object->msisdn) ? $object->msisdn : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), null);
});
Breadcrumbs::register('admin.clients.unlock', function($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.clients.index');
    $breadcrumbs->push(isset($object->msisdn) ? $object->msisdn : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), null);
});
Breadcrumbs::register('admin.clients.deleteEmail', function($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.clients.index');
    $breadcrumbs->push(isset($object->msisdn) ? $object->msisdn : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), null);
});
Breadcrumbs::register('admin.clients.identificate', function($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.clients.index');
    $breadcrumbs->push(isset($object->msisdn) ? $object->msisdn : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), null);
});
