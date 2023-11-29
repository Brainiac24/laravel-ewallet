<div class="form-group">
	{!! Form::label('id', 'ID:', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $account->id }}</p>
	</div>
</div>

<!-- number Field -->
<div class="form-group">
	{!! Form::label('number', trans('accounts.backend.table.number').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $account->number }}</p>
	</div>
</div>

<!-- balance Field -->
<div class="form-group">
	{!! Form::label('balance', trans('accounts.backend.table.balance').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $account->balance_hidden }}</p>
	</div>
</div>
<!-- blocked_balance Field -->
<div class="form-group">
	{!! Form::label('balance', trans('accounts.backend.table.blocked_balance').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $account->blocked_balance }}</p>
	</div>
</div>
<!-- account_type_id Field -->
<div class="form-group">
	{!! Form::label('account_type_id', trans('accounts.backend.table.account_type_id').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $account->account_type->name }}</p>
	</div>
</div>
<!-- user_id Field -->
<div class="form-group">
	{!! Form::label('user_id', trans('accounts.backend.table.user_id').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $account->user->msisdn }}</p>
	</div>
</div><!-- user_id Field -->
<div class="form-group">
	{!! Form::label('user_id', trans('accounts.backend.table.user_id').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $account->user->msisdn }}</p>
	</div>
</div>
<!-- currency_id Field -->
<div class="form-group">
	{!! Form::label('currency_id', trans('accounts.backend.table.currency_id').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $account->currency->name }}</p>
	</div>
</div>

<div class="form-group">
	{!! Form::label('account_status', trans('client.backend.table.is_active').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{$account->account_status->name}}</p>
	</div>
</div>


<div class="form-group">
	{!! Form::label('params_json', trans('accounts.backend.table.params_json').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="{{ $account->params_json==null ?: 'json-params' }}">{{ json_encode($account->params_json, JSON_UNESCAPED_UNICODE) }}</p>
	</div>
</div>

<div class="form-group">
	{!! Form::label('limits_json', trans('accounts.backend.table.limits_json').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="{{ $account->limits_json==null ?: 'json-params' }}">{{ json_encode($account->limits_json, JSON_UNESCAPED_UNICODE) }}</p>
	</div>
</div>