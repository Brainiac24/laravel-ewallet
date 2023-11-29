<?php

// Home > bonusAccrual
Breadcrumbs::register('admin.bonusAccrual.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('bonusAccrual.backend.title'), route('admin.bonusAccrual.index'));
});
// Home > bonusAccrual > Show
Breadcrumbs::register('admin.bonusAccrual.show', function($breadcrumbs, $bonusAccrual) {
    $breadcrumbs->parent('admin.bonusAccrual.index');
    $breadcrumbs->push(isset($bonusAccrual->id) ? $bonusAccrual->id : '', '');
    $breadcrumbs->push(trans('actions.general.view'), '');
});