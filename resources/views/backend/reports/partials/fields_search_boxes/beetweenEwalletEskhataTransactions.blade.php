<div class="form-group">
    {!! Form::label('from_account_id', 'Номер кошелька(Отправитель)', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('from_account_id', null, ['class'=>'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('to_account_msisdn', 'Номер кошелька(Получатель)', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('to_account_msisdn', null, ['class'=>'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('from_date', 'Фильтр по дате', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::date('from_date') !!} - {!! Form::date('to_date') !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('from_date', 'Фильтр по дате завершения', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::date('from_date_finish') !!} - {!! Form::date('to_date_finish') !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('transaction_status_id', 'Статус', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::select('transaction_status_id', $transactionStatuses, ['class'=>'form-control']) !!}
    </div>
</div>