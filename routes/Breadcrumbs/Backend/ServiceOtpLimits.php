<?php

// Home > limits
Breadcrumbs::register('admin.serviceOtpLimits.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('serviceOtpLimits.backend.title'), route('admin.serviceOtpLimits.index'));
});
// Home > limits > Create
Breadcrumbs::register('admin.serviceOtpLimits.create', function($breadcrumbs) {
    $breadcrumbs->parent('admin.serviceOtpLimits.index');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.serviceOtpLimits.index'));
});

Breadcrumbs::register('admin.serviceOtpLimits.edit', function($breadcrumbs, $role) {
    $breadcrumbs->parent('admin.serviceOtpLimits.index');
    $breadcrumbs->push(isset($role->name) ? $role->name : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), '');
});

Breadcrumbs::register('admin.serviceOtpLimits.show', function($breadcrumbs, $role) {
    $breadcrumbs->parent('admin.serviceOtpLimits.index');
    $breadcrumbs->push(isset($role->name) ? $role->name : '', '');
    $breadcrumbs->push(trans('actions.general.view'), '');
});