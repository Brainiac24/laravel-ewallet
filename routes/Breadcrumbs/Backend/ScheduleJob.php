<?php
Breadcrumbs::register('admin.scheduleJobs.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('scheduleJob.backend.title'), route('admin.scheduleJobs.index'));
});
Breadcrumbs::register('admin.scheduleJobs.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.scheduleJobs.index');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.scheduleJobs.index'));
});

Breadcrumbs::register('admin.scheduleJobs.show', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.scheduleJobs.index');
    $breadcrumbs->push(trans('actions.general.view'), '');
});