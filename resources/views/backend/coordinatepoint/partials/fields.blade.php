<!-- Name Field -->
<div class="form-group required">
    {!! Form::label('name', trans('coordinatePoint.backend.name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- code Field -->
<div class="form-group required">
    {!! Form::label('latitude', trans('coordinatePoint.backend.latitude').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('latitude', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group required">
    {!! Form::label('longitude', trans('coordinatePoint.backend.longitude').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('longitude', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group required">
    {!! Form::label('address', trans('coordinatePoint.backend.address').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('address', null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- coordinate_point_type_id Field -->
<div class="form-group ">
    {!! Form::label('coordinate_point_type_id', trans('coordinatePoint.backend.coordinate_point_type_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('coordinate_point_type_id', $coordinatePointTypes,$coordinatePoint->coordinate_point_type_id??null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- coordinate_point_workday_id Field -->
<div class="form-group ">
    {!! Form::label('coordinate_point_workday_id', trans('coordinatePoint.backend.coordinate_point_workday_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('coordinate_point_workday_id', $coordinatePointWorkdays,$coordinatePoint->coordinate_point_workday_id??null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- coordinate_point_city_id Field -->
<div class="form-group required">
    {!! Form::label('coordinate_point_city_id', trans('coordinatePoint.backend.coordinate_point_city_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('coordinate_point_city_id', $coordinatePointCities,$coordinatePoint->coordinate_point_city_id??null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- merchant_id Field -->
<div class="form-group ">
    {!! Form::label('merchant_id', trans('coordinatePoint.backend.merchant_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('merchant_id', $merchants,$coordinatePoint->merchant_id??null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- is_active Field -->
<div class="form-group required">
    {!! Form::label('is_active', trans('coordinatePointType.backend.is_active').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('is_active', trans('InterfaceTranses.enabled'),$coordinatePoint->is_active??null, ['class' => 'form-control']) !!}
    </div>
</div>




