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
    {!! Form::label('attestation_id', trans('client.backend.table.attestation'), ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::select ('attestation_id', $attestations, ['class'=>'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('code_map', trans('client.backend.table.code_map'), ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('code_map', null, ['class'=>'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('from_date', 'Дата регистрации:', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::date('from_date') !!} - {!! Form::date('to_date') !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('devices_json', 'Devices Json:', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('devices_json', null, ['class'=>'form-control']) !!}
    </div>
</div>

