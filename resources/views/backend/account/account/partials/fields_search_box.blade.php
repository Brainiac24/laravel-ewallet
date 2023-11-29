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
    {!! Form::label('number', 'Номер счета содержит', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('number', null, ['class'=>'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('account_type_id', 'Тип счета', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::select('account_type_id', [''=>'']+ $filterAccountTypes, ['class'=>'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('account_status_id', trans('accounts.backend.account_status_id'), ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::select('account_status_id', $filterAccountStatuses, ['class'=>'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('currency_id', trans('accounts.backend.currency_id'), ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::select('currency_id', $filterCurrencies, ['class'=>'form-control']) !!}
    </div>
</div>
