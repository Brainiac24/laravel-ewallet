<?php
/**
 * Created by PhpStorm.
 * User: K_Hakimboev
 * Date: 12.07.2017
 * Time: 12:00
 */

Breadcrumbs::register('admin.users.events.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('event.backend.title'), route('admin.users.events.index'));
});

Breadcrumbs::register('admin.users.events.show', function ($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.users.events.index');
    $breadcrumbs->push(isset($object->name) ? $object->name : '', '');
    $breadcrumbs->push(trans('actions.general.view'), route('admin.users.events.index'));
});
