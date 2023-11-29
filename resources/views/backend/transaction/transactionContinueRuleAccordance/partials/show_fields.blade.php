<div class="row">
    <div class="form-group">
        {!! Form::label('transaction_continue_rule_id', trans('transactionContinueRuleAccordance.backend.transaction_continue_rule_id').':', ['class' => 'control-label col-sm-2']) !!}
        <div class='col-sm-9'>
            <p class="form-control-static">{{$transactionContinueRuleAccordance->transaction_continue_rule->name}}</p>
        </div>
    </div>
</div>
<div class="row">
    <div class="form-group">
        {!! Form::label('transaction_status_id', trans('transactionContinueRuleAccordance.backend.transaction_status_id').':', ['class' => 'control-label col-sm-2']) !!}
        <div class='col-sm-9'>
            <p class="form-control-static">{{$transactionContinueRuleAccordance->transaction_status->name??''}}</p>
        </div>
    </div>
</div>
<div class="row">
    <div class="form-group">
        {!! Form::label('transaction_sync_status_id', trans('transactionContinueRuleAccordance.backend.transaction_sync_status_id').':', ['class' => 'control-label col-sm-2']) !!}
        <div class='col-sm-9'>
            <p class="form-control-static">{{$transactionContinueRuleAccordance->transaction_sync_status->name??''}}</p>
        </div>
    </div>
</div>
<div class="row">
    <div class="form-group">
        {!! Form::label('message', trans('transactionContinueRuleAccordance.backend.users_full_name').':', ['class' => 'control-label col-sm-2']) !!}
        <div class='col-sm-9'>
            <p class="form-control-static">{{$usersFullName}}</p>
        </div>
    </div>
</div>
<div class="row">
    <div class="form-group">
        {!! Form::label('message', trans('transactionContinueRuleAccordance.backend.message').':', ['class' => 'control-label col-sm-2']) !!}
        <div class='col-sm-9'>
            <p class="form-control-static">{{$transactionContinueRuleAccordance->message}}</p>
        </div>
    </div>
</div>
<div class="row">
    <div class="form-group">
        {!! Form::label('is_active', trans('transactionContinueRuleAccordance.backend.is_active').':', ['class' => 'control-label col-sm-2']) !!}
        <div class='col-sm-9'>
            <p class="form-control-static">{{ trans('InterfaceTranses.enabled.'.$transactionContinueRuleAccordance->is_active) }}</p>
        </div>
    </div>
</div>
<div class="row">
    <div class="form-group">
        {!! Form::label('created_at', trans('transactionContinueRuleAccordance.backend.created_at').':', ['class' => 'control-label col-sm-2']) !!}
        <div class='col-sm-9'>
            <p class="form-control-static">{{ empty($transactionContinueRuleAccordance->created_at)?null:\Carbon\Carbon::parse($transactionContinueRuleAccordance->created_at)->format("d.m.Y H:i:s") }}</p>
        </div>
    </div>
</div>
<div class="row">
    <div class="form-group">
        {!! Form::label('updated_at', trans('transactionContinueRuleAccordance.backend.updated_at').':', ['class' => 'control-label col-sm-2']) !!}
        <div class='col-sm-9'>
            <p class="form-control-static">{{ empty($transactionContinueRuleAccordance->updated_at)?null:\Carbon\Carbon::parse($transactionContinueRuleAccordance->updated_at)->format("d.m.Y H:i:s") }}</p>
        </div>
    </div>
</div>