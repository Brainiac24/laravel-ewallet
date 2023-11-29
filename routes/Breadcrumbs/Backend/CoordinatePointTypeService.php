<?php


Breadcrumbs::register('admin.coordinatepointTypes.services.index', function($breadcrumbs) {
});
Breadcrumbs::register('admin.coordinatepointTypes.services.create', function($breadcrumbs, $object) {
    $breadcrumbs->parent('admin.coordinatepointTypes.show', $object);
    $breadcrumbs->push(trans('coordinatePointTypeService.backend.title'), '');
    $breadcrumbs->push(trans('actions.general.create'), route('admin.coordinatepointTypes.show', $object->id));
});

Breadcrumbs::register('admin.coordinatepointTypes.services.edit', function($breadcrumbs, $object, $id) {
    $breadcrumbs->parent('admin.coordinatepointTypes.show', $object);
    $breadcrumbs->push(trans('coordinatePointTypeService.backend.title'), '');
    $breadcrumbs->push(trans('actions.general.edit'), route('admin.coordinatepointTypes.show', $object->id));
});

Breadcrumbs::register('admin.coordinatepointTypes.services.show', function($breadcrumbs, $object, $id) {
    $breadcrumbs->parent('admin.coordinatepointTypes.show', $object);
    $breadcrumbs->push(trans('transactionContinueRuleAccordance.backend.title'), '');
    $breadcrumbs->push(trans('actions.general.view'), route('admin.coordinatepointTypes.show', $object->id));
});
