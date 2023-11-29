<div class="form-group required">
    {!! Form::label('transaction_status_id', trans('transactionContinueRule.backend.transaction_status_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('transaction_status_id', $transactionStatus , null,['class' => 'form-control']) !!}
    </div>
</div>
{!! Form::hidden('id',null,['class' => 'form-control']) !!}


<div class="form-group required">
    {!! Form::label('transaction_sync_status_id', trans('transactionContinueRule.backend.transaction_sync_status_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('transaction_sync_status_id', $transactionSyncStatus , null,['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('from_gateway_id', trans('transactionContinueRule.backend.from_gateway_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('from_gateway_id', $gateways , null,['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('to_gateway_id', trans('transactionContinueRule.backend.to_gateway_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('to_gateway_id', $gateways , null,['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('is_active', trans('transactionContinueRule.backend.is_active').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('is_active',  trans('InterfaceTranses.enabled'),  null, ['class' => 'form-control']) !!}
    </div>
</div>

@if(!Route::is('admin.transactions.continueRules.create'))
    <hr>
    <h3>Доступны статусы изменений для пользователей</h3>
    @foreach($transactionContinueRuleAccordances as $item)
        <div class="form-group required">
            {!! Form::label('allowed_users', $item->transaction_status->name.':', ['class' => 'control-label col-sm-2']) !!}
            <div class='col-sm-9'>
                {!! Form::select('allowed_users', $users, $item->allowed_users??null, ['name' => 'allowed_users['.$item->id.'][]', 'id' => 'select2_perms', 'class' => 'form-control select2 ', 'data-placeholder' => 'Выберите пользователь', 'multiple']) !!}
            </div>
        </div>
    @endforeach
@endif