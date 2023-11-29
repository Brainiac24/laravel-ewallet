<!-- version Field -->
<div class="form-group required">
    {!! Form::label('version', trans('coordinatePointCity.backend.version').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::number('version', null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- city_id Field -->
<div class="form-group required">
    {!! Form::label('city_id', trans('coordinatePointCity.backend.city_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('city_id', $cities,$coordinatePointCity->city_id??null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- is_active Field -->
<div class="form-group required">
    {!! Form::label('is_active', trans('coordinatePointCity.backend.is_active').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('is_active', trans('InterfaceTranses.enabled'),$coordinatePointCity->is_active??null, ['class' => 'form-control']) !!}
    </div>
</div>