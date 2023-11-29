<div class="form-group">
    {!! Form::label('msisdn', 'Номер телефона', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('msisdn', null, ['class'=>'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('params_json', 'Содержимое контактов', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('params_json', null, ['class'=>'form-control']) !!}
    </div>
</div>
