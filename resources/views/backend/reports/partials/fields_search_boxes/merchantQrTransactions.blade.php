<div class="form-group">
    {!! Form::label('merchant_id', 'Мерчант', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::select('merchant_id', $merchants) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('from_date', 'Фильтр по дате', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::date('from_date') !!} - {!! Form::date('to_date') !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('from_date_finish', 'Фильтр по дате завершения', ['class' => 'col-sm-5 control-label']) !!}
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