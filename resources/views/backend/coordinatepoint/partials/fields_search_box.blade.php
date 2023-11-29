<div class="form-group">
    {!! Form::label('name', 'Имя Объекта', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('name', null, ['class'=>'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('address', trans('coordinatePoint.backend.address'), ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('address', null, ['class'=>'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('objt', 'Тип Объекта', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::select('objt', [''=>'',1=>'Пункты обслуживания' ,2=>'Терминалы' , 3=>'Банкоматы' ], ['class'=>'form-control']) !!}
    </div>
</div>
<!-- coordinate_point_type_id Field -->
<div class="form-group ">
    {!! Form::label('coordinate_point_type_id', trans('coordinatePoint.backend.coordinate_point_type_id').':', ['class' => 'col-sm-5 control-label']) !!}
    <div class='col-sm-3'>
        {!! Form::select('coordinate_point_type_id', $coordinatePointTypes,null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- coordinate_point_workday_id Field -->
<div class="form-group ">
    {!! Form::label('coordinate_point_workday_id', trans('coordinatePoint.backend.coordinate_point_workday_id').':', ['class' => 'col-sm-5 control-label']) !!}
    <div class='col-sm-3'>
        {!! Form::select('coordinate_point_workday_id', $coordinatePointWorkdays,null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- merchant_id Field -->
<div class="form-group ">
    {!! Form::label('merchant_id', trans('coordinatePoint.backend.merchant_id').':', ['class' => 'control-label col-sm-5']) !!}
    <div class='col-sm-3'>
        {!! Form::select('merchant_id', $merchants,null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('is_active', 'Доступность', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::select('is_active', [''=>'',1=>'Активный' ,0=>'Неактивный' ], ['class'=>'form-control']) !!}
    </div>
</div>