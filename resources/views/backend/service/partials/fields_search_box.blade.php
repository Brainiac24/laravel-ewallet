<div class="form-group">
    {!! Form::label('name', 'Имя сервиса', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('name', null, ['class'=>'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('processing_code', 'Код процессинга', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('processing_code', null, ['class'=>'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('code', 'Код сервиса', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('code', null, ['class'=>'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('params_json', 'Параметры', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('params_json', null, ['class'=>'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('gateway_id', 'Шлюзы', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::select ('gateway_id', $gateways, ['class'=>'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('currency_id', 'Валюта', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::select('currency_id', $currencies, ['class'=>'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('workday_id', 'Рабочие дни', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::select('workday_id', $workdays, ['class'=>'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('is_checkable', 'Проверка доступности сервиса', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::select('is_checkable', trans('InterfaceTranses.yesno'), ['class'=>'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('is_active', 'Статус', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::select('is_active', trans('InterfaceTranses.enabled'), ['class'=>'form-control']) !!}
    </div>
</div>
