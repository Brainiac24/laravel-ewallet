<!-- NAME Field -->
<div class="form-group">
    {!! Form::label('coordinate_point_type_id', trans('coordinatePointTypeService.backend.table.coordinate_point_type_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $coordinatePointTypeService->coordinate_point_type->name }}</p>
    </div>
</div>

<!-- coordinate_point_workday Field -->
<div class="form-group">
    {!! Form::label('coordinate_point_service_id', trans('coordinatePointTypeService.backend.table.coordinate_point_service_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $coordinatePointTypeService->coordinate_point_service->name }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('is_active', trans('coordinatePointTypeService.backend.table.is_active').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{trans('InterfaceTranses.is_active.'. $coordinatePointTypeService->is_active )}}</p>
    </div>
</div>

<!-- Created_at Field -->
<div class="form-group">
    {!! Form::label('created_at', trans('coordinatePointTypeService.backend.table.created_at').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $coordinatePointTypeService->created_at }}</p>
    </div>
</div>
<!-- updated_at Field -->
<div class="form-group">
    {!! Form::label('updated_at', trans('coordinatePointTypeService.backend.table.updated_at').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $coordinatePointTypeService->updated_at }}</p>
    </div>
</div>