<div class="form-group">
    {!! Form::label('transaction_status_id', trans('transactionContinueRule.backend.transaction_status_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{$transactionContinueRule->transaction_status->name}}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('transaction_sync_status_id', trans('transactionContinueRule.backend.transaction_sync_status_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{$transactionContinueRule->transaction_sync_status->name}}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('from_gateway_id', trans('transactionContinueRule.backend.from_gateway_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{$transactionContinueRule->from_gateway->name}}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('to_gateway_id', trans('transactionContinueRule.backend.to_gateway_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{$transactionContinueRule->to_gateway->name}}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('is_active', trans('transactionContinueRule.backend.is_active').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ trans('InterfaceTranses.enabled.'.$transactionContinueRule->is_active) }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('created_at', trans('transactionContinueRule.backend.created_at').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ empty($transactionContinueRule->created_at)?null:\Carbon\Carbon::parse($transactionContinueRule->created_at)->format("d.m.Y H:i:s") }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('updated_at', trans('transactionContinueRule.backend.updated_at').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ empty($transactionContinueRule->updated_at)?null:\Carbon\Carbon::parse($transactionContinueRule->updated_at)->format("d.m.Y H:i:s") }}</p>
    </div>
</div>
