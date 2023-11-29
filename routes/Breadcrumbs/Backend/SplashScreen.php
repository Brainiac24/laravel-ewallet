<?php
Breadcrumbs::register('admin.splashScreens.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('splashScreen.backend.title'), route('admin.splashScreens.index'));
});