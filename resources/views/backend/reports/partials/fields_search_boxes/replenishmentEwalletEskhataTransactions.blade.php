
<div class="form-group">
    {!! Form::label('from_date', 'Фильтр по дате', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::date('from_date') !!} - {!! Form::date('to_date') !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('transaction_status_id', 'Статус транзакции', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::select('transaction_status_id', $transactionStatuses, ['class'=>'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('transaction_type_id', 'Тип операции', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::select('transaction_type_id', $transactionTypes, ['class'=>'form-control']) !!}
    </div>
</div>



