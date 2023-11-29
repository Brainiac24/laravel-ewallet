<div class="form-group">
    {!! Form::label('id', 'ID', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('id', null, ['class'=>'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('transaction_status_id', trans('transactionContinueRule.backend.transaction_status_id').':', ['class' => 'control-label col-sm-5']) !!}
    <div class='col-sm-3'>
        {!! Form::select('transaction_status_id', [''=>'']+$filterTransactionStatus , null,['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('transaction_sync_status_id', trans('transactionContinueRule.backend.transaction_sync_status_id').':', ['class' => 'control-label col-sm-5']) !!}
    <div class='col-sm-3'>
        {!! Form::select('transaction_sync_status_id', [''=>'']+$filterTransactionSyncStatus , null,['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('from_gateway_id', trans('transactionContinueRule.backend.from_gateway_id').':', ['class' => 'control-label col-sm-5']) !!}
    <div class='col-sm-3'>
        {!! Form::select('from_gateway_id', [''=>'']+$filterGateways , null,['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('to_gateway_id', trans('transactionContinueRule.backend.to_gateway_id').':', ['class' => 'control-label col-sm-5']) !!}
    <div class='col-sm-3'>
        {!! Form::select('to_gateway_id', [''=>'']+$filterGateways , null,['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('is_active', trans('transactionContinueRule.backend.is_active').':', ['class' => 'control-label col-sm-5']) !!}
    <div class='col-sm-3'>
        {!! Form::select('is_active',  trans('InterfaceTranses.enabled'),  null, ['class' => 'form-control']) !!}
    </div>
</div>
