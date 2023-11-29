<!-- coordinate_point_type_id Field -->
<div class="form-group required">
    {!! Form::label('coordinate_point_type_id', trans('coordinatePointTypeService.backend.coordinate_point_type_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('coordinate_point_type_name', $coordinatePointType->name, ['class' => 'form-control', 'readonly']) !!}
        {!! Form::hidden('coordinate_point_type_id', $coordinatePointType->id??$coordinatePointTypeService->coordinate_point_type_id, ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>

<!-- coordinate_point_service_id Field -->
<div class="form-group required">
    {!! Form::label('coordinate_point_service_id', trans('coordinatePointTypeService.backend.coordinate_point_service_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('coordinate_point_service_id', $coordinatePointServices,$coordinatePointTypeService->coordinate_point_service_id??null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- is_active Field -->
<div class="form-group required">
    {!! Form::label('is_active', trans('coordinatePointTypeService.backend.is_active').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('is_active', trans('InterfaceTranses.enabled'),$FAQQuestion->is_active??null, ['class' => 'form-control']) !!}
    </div>
</div>

