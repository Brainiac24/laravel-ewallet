<div class="form-group required">
    {!! Form::label('transaction_continue_rule_id', trans('transactionContinueRuleAccordance.backend.transaction_continue_rule_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('transaction_continue_rule_name', $transactionContinueRule->name??null, ['class' => 'form-control', 'readonly']) !!}
        {!! Form::hidden('transaction_continue_rule_id', $transactionContinueRule->id, ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>
{!! Form::hidden('id',null,['class' => 'form-control']) !!}

<div class="form-group required">
    {!! Form::label('transaction_status_id', trans('transactionContinueRuleAccordance.backend.transaction_status_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('transaction_status_id', [''=>'']+$transactionStatus , null,['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('transaction_sync_status_id', trans('transactionContinueRuleAccordance.backend.transaction_sync_status_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('transaction_sync_status_id', [''=>'']+$transactionSyncStatus , null,['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('message', trans('transactionContinueRuleAccordance.backend.message').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('message', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('is_active', trans('transactionContinueRule.backend.is_active').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('is_active',  trans('InterfaceTranses.enabled'),  null, ['class' => 'form-control']) !!}
    </div>
</div>
