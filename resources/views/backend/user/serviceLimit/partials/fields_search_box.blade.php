<div class="form-group">
    {!! Form::label('msisdn', 'Номер телефона', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('msisdn', null, ['class'=>'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('full_name', 'ФИО содержит', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('full_name', null, ['class'=>'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('params_json', 'Параметры', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('params_json', null, ['class'=>'form-control']) !!}
    </div>
</div>
{{--<div class="form-group">--}}
    {{--{!! Form::label('service', 'Сервис', ['class' => 'col-sm-5 control-label']) !!}--}}
    {{--<div class="col-sm-3">--}}
        {{--{!! Form::select('service', ['-1'=>''], ['class'=>'form-control']) !!}--}}
    {{--</div>--}}
{{--</div>--}}

<div class="form-group">
    {!! Form::label('service_id', 'Сервис', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::select('service_id', [''=>'']+ $services, ['class'=>'form-control']) !!}
    </div>
</div>

