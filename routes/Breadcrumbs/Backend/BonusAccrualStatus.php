<?php

// Home > bonusAccrualStatus
Breadcrumbs::register('admin.bonusAccrualStatus.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('bonusAccrualStatus.backend.title'), route('admin.bonusAccrualStatus.index'));
});
// Home > bonusAccrualStatus > Create
Breadcrumbs::register('admin.bonusAccrualStatus.create', function($breadcrumbs) {
    $breadcrumbs->parent('admin.bonusAccrualStatus.index');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.bonusAccrualStatus.index'));
});
// Home > bonusAccrualStatus > edit
Breadcrumbs::register('admin.bonusAccrualStatus.edit', function($breadcrumbs, $bonusAccrualStatus) {
    $breadcrumbs->parent('admin.bonusAccrualStatus.index');
    $breadcrumbs->push(isset($bonusAccrualStatus->name) ? $bonusAccrualStatus->name : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), '');
});
// Home > bonusAccrualStatus > Show
Breadcrumbs::register('admin.bonusAccrualStatus.show', function($breadcrumbs, $bonusAccrualStatus) {
    $breadcrumbs->parent('admin.bonusAccrualStatus.index');
    $breadcrumbs->push(isset($bonusAccrualStatus->name) ? $bonusAccrualStatus->name : '', '');
    $breadcrumbs->push(trans('actions.general.view'), '');
});