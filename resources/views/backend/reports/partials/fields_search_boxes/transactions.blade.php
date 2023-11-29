<div class="form-group">
    {!! Form::label('id', 'ID', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('id', null, ['class'=>'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('created_by_user_id',trans("transaction.backend.table.created_by_user_id"), ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('created_by_user_id', null, ['class'=>'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('from_account_id', trans("transaction.backend.table.from_account_id"), ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('from_account_id', null, ['class'=>'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('to_account_msisdn', trans("transaction.backend.table.to_account_id"), ['class' => 'col-sm-5 control-label']) !!}
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
    {!! Form::label('session_in', trans("transaction.backend.table.session_in"), ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('session_in', null, ['class'=>'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('from_gateway_id', trans("transaction.backend.table.from_gateway_id"), ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::select('from_gateway_id', $gateways, ['class'=>'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('to_gateway_id', trans("transaction.backend.table.to_gateway_id"), ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::select('to_gateway_id', $gateways, ['class'=>'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('service_id', trans("transaction.backend.table.service_id"), ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::select('service_id', [''=>'']+ $services, ['class'=>'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('merchant_id', trans("transaction.backend.table.merchant_id"), ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::select('merchant_id', [''=>'']+ $merchants, ['class'=>'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('transaction_status_group_id', 'Группа статусов', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::select('transaction_status_group_id', [''=>'']+ $transactionStatusGroups, ['class'=>'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('transaction_status_id', 'Статус', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::select('transaction_status_id', [''=>'']+ $transactionStatuses, ['class'=>'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('transaction_sync_status_id', 'Статус синхронизации', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::select('transaction_sync_status_id', [''=>'']+ $transactionSyncStatus, ['class'=>'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('order_id', trans("transaction.backend.table.order_id"), ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('order_id', null, ['class'=>'form-control']) !!}
    </div>
</div>



