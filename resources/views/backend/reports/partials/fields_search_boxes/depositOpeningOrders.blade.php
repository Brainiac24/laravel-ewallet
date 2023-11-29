
<div class="form-group">
    {!! Form::label('order_status_id', 'Статус', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::select('order_status_id',  $filterOrderStatus, ['class'=>'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('order_process_status_id', 'Статус процесса', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::select('order_process_status_id',  $filterOrderProcessStatus, ['class'=>'form-control']) !!}
    </div>
</div>


<div class="form-group">
    {!! Form::label('from_date', 'Дата создания', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::date('from_created_at') !!} - {!! Form::date('to_created_at') !!}
    </div>
</div>