<?php

// Home > documentType
Breadcrumbs::register('admin.documentTypes.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('documentType.backend.title'), route('admin.documentTypes.index'));
});
// Home > documentType > Create
Breadcrumbs::register('admin.documentTypes.create', function($breadcrumbs) {
    $breadcrumbs->parent('admin.documentTypes.index');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.documentTypes.index'));
});
// Home > documentType > edit
Breadcrumbs::register('admin.documentTypes.edit', function($breadcrumbs, $role) {
    $breadcrumbs->parent('admin.documentTypes.index');
    $breadcrumbs->push(isset($role->name) ? $role->name : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), '');
});
// Home > documentType > Show
Breadcrumbs::register('admin.documentTypes.show', function($breadcrumbs, $role) {
    $breadcrumbs->parent('admin.documentTypes.index');
    $breadcrumbs->push(isset($role->name) ? $role->name : '', '');
    $breadcrumbs->push(trans('actions.general.view'), '');
});