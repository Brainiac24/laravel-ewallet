<!-- number Field -->
<div class="form-group">
	{!! Form::label('number', trans('accountHistory.backend.table.number').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $accountTypeRepositoryContract->number }}</p>
	</div>
</div>
<!-- balance Field -->
<div class="form-group">
	{!! Form::label('balance', trans('accountHistory.backend.table.balance').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $accountTypeRepositoryContract->balance }}</p>
	</div>
</div>
<!-- account_type_id Field -->
<div class="form-group">
	{!! Form::label('account_type_id', trans('accountHistory.backend.table.account_type_id').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $accountTypeRepositoryContract->account_type_id }}</p>
	</div>
</div>
<!-- user_id Field -->
<div class="form-group">
	{!! Form::label('user_id', trans('accountHistory.backend.table.user_id').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $accountTypeRepositoryContract->user_id }}</p>
	</div>
</div>
<!-- currency_id Field -->
<div class="form-group">
	{!! Form::label('currency_id', trans('accountHistory.backend.table.currency_id').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $accountTypeRepositoryContract->currency_id }}</p>
	</div>
</div>

<!-- transaction_types_id Field -->
<div class="form-group">
	{!! Form::label('transaction_types_id', trans('accountHistory.backend.table.transaction_types_id').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $accountTypeRepositoryContract->transaction_types_id }}</p>
	</div>
</div>
<!-- currency_rate_value Field -->
<div class="form-group">
	{!! Form::label('currency_rate_value', trans('accountHistory.backend.table.currency_rate_value').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $accountTypeRepositoryContract->currency_rate_value }}</p>
	</div>
</div>
<!-- created_at Field -->
<div class="form-group">
	{!! Form::label('created_at', trans('accountHistory.backend.table.created_at').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $accountTypeRepositoryContract->created_at }}</p>
	</div>
</div>
<!-- updated_at Field -->
<div class="form-group">
	{!! Form::label('updated_at', trans('accountHistory.backend.table.updated_at').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $accountTypeRepositoryContract->updated_at }}</p>
	</div>
</div>