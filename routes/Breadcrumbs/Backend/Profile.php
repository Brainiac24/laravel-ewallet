<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2017
 * Time: 12:00
 */

// Home > Users
Breadcrumbs::register('admin.profile', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('profile.backend.title'));
});