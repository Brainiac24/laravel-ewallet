<div class="form-group">
    {!! Form::label('id', trans('ID'), ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('id', null, ['class'=>'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('full_name', 'ФИО содержит', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('full_name', null, ['class'=>'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('merchant_name', 'Название содержит', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('merchant_name', null, ['class'=>'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('account_number', 'Номер счета содержит', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('account_number', null, ['class'=>'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('msisdn', 'Номер телефона', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('msisdn', null, ['class'=>'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('is_active', trans('merchantUser.backend.is_active'), ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::select('is_active', trans('InterfaceTranses.enabled'), ['class'=>'form-control']) !!}
    </div>
</div>