<!-- Name Field -->
<div class="form-group required">
    {!! Form::label('name', trans('coordinatePointType.backend.name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- code Field -->
<div class="form-group required">
    {!! Form::label('code', trans('coordinatePointType.backend.code').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('code', null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- coordinate_point_workday_id Field -->
<div class="form-group required">
    {!! Form::label('coordinate_point_workday_id', trans('coordinatePointType.backend.coordinate_point_workday_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('coordinate_point_workday_id', $coordinatePointWorkdays,$coordinatePointType->coordinate_point_workday_id??null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- position Field -->
<div class="form-group required">
    {!! Form::label('position', trans('coordinatePointType.backend.position').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::number('position', null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- is_show_for_filter Field -->
<div class="form-group required">
    {!! Form::label('is_show_for_filter', trans('coordinatePointType.backend.is_show_for_filter').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('is_show_for_filter', trans('InterfaceTranses.verified'),$coordinatePointType->is_show_for_filter??null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- is_active Field -->
<div class="form-group required">
    {!! Form::label('is_active', trans('coordinatePointType.backend.is_active').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('is_active', trans('InterfaceTranses.enabled'),$coordinatePointType->is_active??null, ['class' => 'form-control']) !!}
    </div>
</div>
