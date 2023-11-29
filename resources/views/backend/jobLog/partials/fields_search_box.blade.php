<div class="form-group">
    {!! Form::label('id', 'ID', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('id', null, ['class'=>'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('created_by_user_msisdn','Номер телефона', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('created_by_user_msisdn', null, ['class'=>'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('transaction_id', 'Transaction ID', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('transaction_id', null, ['class'=>'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('order_id', 'ID заявки', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('order_id', null, ['class'=>'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('is_from_archive', 'Получить из архива', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::checkbox('is_from_archive', 1,null,["style" => "margin-top: 12px;"]) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('type', 'Тип', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::select('type', [''=>''] + config('job_log_type_helper')['types'],null,["style" => "margin-top: 12px;"]) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('from_date', 'Фильтр по дате', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::date('from_date') !!} - {!! Form::date('to_date') !!}
    </div>
</div>
