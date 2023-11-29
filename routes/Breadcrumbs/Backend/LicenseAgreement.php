<?php
Breadcrumbs::register('admin.license.edit', function($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    //$breadcrumbs->push(isset($license) ? $license : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), '');
});

Breadcrumbs::register('admin.license.store', function($breadcrumbs) {
    $breadcrumbs->push(isset($license) ? $license : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), '');
});