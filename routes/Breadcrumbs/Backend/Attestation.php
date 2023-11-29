<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2017
 * Time: 12:00
 */

// Home > Roles
Breadcrumbs::register('admin.attestations.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('attestations.backend.attestation'), route('admin.attestations.index'));
});
// Home > Roles > Create
Breadcrumbs::register('admin.attestations.create', function($breadcrumbs) {
    $breadcrumbs->parent('admin.attestations.index');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.attestations.index'));
});

Breadcrumbs::register('admin.attestations.edit', function($breadcrumbs, $role) {
    $breadcrumbs->parent('admin.attestations.index');
    $breadcrumbs->push(isset($role->name) ? $role->name : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), '');
});

Breadcrumbs::register('admin.attestations.show', function($breadcrumbs, $role) {
    $breadcrumbs->parent('admin.attestations.index');
    $breadcrumbs->push(isset($role->name) ? $role->name : '', '');
    $breadcrumbs->push(trans('actions.general.view'), '');
});