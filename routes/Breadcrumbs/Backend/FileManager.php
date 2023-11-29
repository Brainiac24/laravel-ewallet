<?php
Breadcrumbs::register('admin.fileManager.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('fileManager.backend.title'), route('admin.fileManager.index'));
});
