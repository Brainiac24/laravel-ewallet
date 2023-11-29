<!-- id Field -->
<div class="form-group">
    {!! Form::label('id', trans('transactionHistory.backend.table.id').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
            <p class="form-control-static">{{ $transactionHistory->id }}</p>
	</div>
</div>
<!-- from_account_id Field -->
<div class="form-group">
	{!! Form::label('from_account_id', trans('transactionHistory.backend.table.from_account_id').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $transactionHistory->from_account->number??null }}</p>
	</div>
</div>
<!-- to_account_id Field -->
<div class="form-group">
	{!! Form::label('to_account_id', trans('transactionHistory.backend.table.to_account_id').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $transactionHistory->to_account->number??null }}</p>
	</div>
</div>
<!-- service_id Field -->
<div class="form-group">
	{!! Form::label('service_id', trans('transactionHistory.backend.table.service_id').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $transactionHistory->service->name }}</p>
	</div>
</div>
<!-- amount Field -->
<div class="form-group">
	{!! Form::label('amount', trans('transactionHistory.backend.table.amount').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $transactionHistory->amount }}</p>
	</div>
</div>
<!-- amount_all Field -->
<div class="form-group">
	{!! Form::label('amount_all', trans('transactionHistory.backend.table.amount_all').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $transactionHistory->amount_all }}</p>
	</div>
</div>
<!-- params_json Field -->
<div class="form-group">
	{!! Form::label('params_json', trans('transactionHistory.backend.table.params_json').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ json_encode($transactionHistory->params_json) }}</p>
	</div>
</div>
<!-- session_number Field -->
<div class="form-group">
	{!! Form::label('session_number', trans('transactionHistory.backend.table.session_number').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $transactionHistory->session_number }}</p>
	</div>
</div>
<!-- transaction_type_id Field -->
<div class="form-group">
	{!! Form::label('transaction_type_id', trans('transactionHistory.backend.table.transaction_type_id').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $transactionHistory->TransactionType->name }}</p>
	</div>
</div>
<!-- finished_at Field -->
<div class="form-group">
	{!! Form::label('finished_at', trans('transactionHistory.backend.table.finished_at').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $transactionHistory->finished_at }}</p>
	</div>
</div>
<!-- next_try_at Field -->
<div class="form-group">
	{!! Form::label('next_try_at', trans('transactionHistory.backend.table.next_try_at').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $transactionHistory->next_try_at }}</p>
	</div>
</div>
<!-- created_by_user_id Field -->
<div class="form-group">
	{!! Form::label('created_by_user_id', trans('transactionHistory.backend.table.created_by_user_id').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $transactionHistory->created_by_user_id }}</p>
	</div>
</div>
<!-- transaction_status_id Field -->
<div class="form-group">
	{!! Form::label('transaction_status_id', trans('transactionHistory.backend.table.transaction_status_id').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $transactionHistory->TransactionStatus->name }}</p>
	</div>
</div>
<!-- transaction_status_detail_id Field -->
<div class="form-group">
	{!! Form::label('transaction_status_detail_id', trans('transactionHistory.backend.table.transaction_status_detail_id').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $transactionHistory->TransactionStatusDetail->name }}</p>
	</div>
</div>
<!-- try_count Field -->
<div class="form-group">
	{!! Form::label('try_count', trans('transactionHistory.backend.table.try_count').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $transactionHistory->try_count }}</p>
	</div>
</div>

<!-- flag Field -->
<div class="form-group">
	{!! Form::label('flag', trans('transactionHistory.backend.table.flag').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $transactionHistory->flag }}</p>
	</div>
</div>
<!-- comment Field -->
<div class="form-group">
	{!! Form::label('comment', trans('transactionHistory.backend.table.comment').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $transactionHistory->comment }}</p>
	</div>
</div>
<!-- parent_id Field -->
<div class="form-group">
	{!! Form::label('parent_id', trans('transactionHistory.backend.table.parent_id').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $transactionHistory->parent_id }}</p>
	</div>
</div>
<!-- currency_rate_value Field -->
<div class="form-group">
	{!! Form::label('currency_rate_value', trans('transactionHistory.backend.table.currency_rate_value').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $transactionHistory->currency_rate_value }}</p>
	</div>
</div>
<!-- currency_iso_name Field -->
<div class="form-group">
	{!! Form::label('currency_iso_name', trans('transactionHistory.backend.table.currency_iso_name').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $transactionHistory->currency_iso_name }}</p>
	</div>
</div>

<!-- account_balance Field -->
<div class="form-group">
	{!! Form::label('account_balance', trans('transactionHistory.backend.table.account_balance').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $transactionHistory->account_balance }}</p>
	</div>
</div>
<!-- request Field -->
<div class="form-group">
	{!! Form::label('request', trans('transactionHistory.backend.table.request').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $transactionHistory->request }}</p>
	</div>
</div>
<!-- response Field -->
<div class="form-group">
	{!! Form::label('response', trans('transactionHistory.backend.table.response').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $transactionHistory->response }}</p>
	</div>
</div>
<!-- created_at Field -->
<div class="form-group">
	{!! Form::label('created_at', trans('gateways.backend.table.created_at').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $transactionHistory->created_at }}</p>
	</div>
</div>
<!-- updated_at Field -->
<div class="form-group">
	{!! Form::label('updated_at', trans('gateways.backend.table.updated_at').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $transactionHistory->updated_at }}</p>
	</div>
</div>