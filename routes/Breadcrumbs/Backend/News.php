<?php
/**
 * Created by PhpStorm.
 * User: Ladmin
 * Date: 27.09.2019
 * Time: 11:40
 */

Breadcrumbs::register('admin.news.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('news.backend.title'), route('admin.news.index'));
});

Breadcrumbs::register('admin.news.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.news.index');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.news.index'));
});
//
Breadcrumbs::register('admin.news.show', function ($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.news.index');
    $breadcrumbs->push(isset($object->title) ? $object->title : '', '');
    $breadcrumbs->push(trans('actions.general.view'), route('admin.news.index'));
});
//
Breadcrumbs::register('admin.news.edit', function ($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.news.index');
    $breadcrumbs->push(isset($object->title) ? $object->title : '', '');
    $breadcrumbs->push(trans('actions.general.edit'), '');
});