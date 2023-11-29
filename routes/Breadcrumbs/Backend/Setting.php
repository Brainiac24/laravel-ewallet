<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2017
 * Time: 12:00
 */

// Home > workdays
Breadcrumbs::register('admin.settings.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('setting.backend.title'), route('admin.settings.index'));
});
// Home > workdays > Create
Breadcrumbs::register('admin.settings.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.settings.index');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.settings.index'));
});
// Home > workdays > edit
Breadcrumbs::register('admin.settings.edit', function ($breadcrumbs, $setting) {
    $breadcrumbs->parent('admin.settings.index');
    !is_object($setting) ?: $breadcrumbs->push(isset($setting->key) ? $setting->key : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), '');
});
