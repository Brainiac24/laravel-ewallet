<?php

// Home > report_analysis
Breadcrumbs::register('admin.report_analysis.index', function($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('reportAnalysis.backend.title'), route('admin.report_analysis.index'));
});
// Home > report_analysis > Create
Breadcrumbs::register('admin.report_analysis.create', function($breadcrumbs) {
    $breadcrumbs->parent('admin.report_analysis.index');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.report_analysis.index'));
});
// Home > report_analysis > edit
Breadcrumbs::register('admin.report_analysis.edit', function($breadcrumbs, $data) {
    $breadcrumbs->parent('admin.report_analysis.index');
    $breadcrumbs->push(isset($data->name) ? $data->name : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), '');
});
// Home > report_analysis > Show
Breadcrumbs::register('admin.report_analysis.show', function($breadcrumbs, $data) {
    $breadcrumbs->parent('admin.report_analysis.index');
    $breadcrumbs->push(isset($data->name) ? $data->name : '', '');
    $breadcrumbs->push(trans('actions.general.view'), '');
});