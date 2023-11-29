<?php

Breadcrumbs::register('admin.reports.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('reports.backend.title'), route('admin.reports.index'));
});