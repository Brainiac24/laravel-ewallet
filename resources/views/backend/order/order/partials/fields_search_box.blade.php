<div class="form-group">
    {!! Form::label('id', 'ID', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('id', null, ['class'=>'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('from_user_id', trans('order.backend.table.from_user'), ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('from_user_id', null, ['class'=>'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('to_user_id', trans('order.backend.table.to_user'), ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('to_user_id', null, ['class'=>'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('order_type_id', trans('order.backend.table.order_type'), ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::select('order_type_id', [''=>'']+ $filterOrderTypes, ['class'=>'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('order_status_id', 'Статус', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::select('order_status_id',  $filterOrderStatus, ['class'=>'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('order_process_status_id', 'Статус оброботки', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::select('order_process_status_id',  $filterOrderProcessStatus, ['class'=>'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('from_date_create', 'Фильтр по дате создание', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::date('from_date_create') !!} - {!! Form::date('to_date_create') !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('from_date_update', 'Фильтр по дате изменение', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::date('from_date_update') !!} - {!! Form::date('to_date_update') !!}
    </div>
</div>



