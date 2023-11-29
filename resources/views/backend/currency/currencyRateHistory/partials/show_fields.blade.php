<!-- code Field -->
<div class="form-group">
    {!! Form::label('code', trans('currencyRateHistory.backend.table.currency_id').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
            <p class="form-control-static">{{ $currencyRateHistory->currency->name }}</p>
	</div>
</div>
<!-- value_buy Field -->
<div class="form-group">
	{!! Form::label('value_buy', trans('currencyRateHistory.backend.table.value_buy').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $currencyRateHistory->value_buy }}</p>
	</div>
</div>
<!-- value_buy Field -->
<div class="form-group">
	{!! Form::label('value_sell', trans('currencyRateHistory.backend.table.value_sell').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $currencyRateHistory->value_sell }}</p>
	</div>
</div>
<!-- updated_at Field -->
<div class="form-group">
	{!! Form::label('updated_at', trans('currencyRateHistory.backend.table.updated_at').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $currencyRateHistory->updated_at }}</p>
	</div>
</div>
<!-- created_at Field -->
<div class="form-group">
	{!! Form::label('created_at', trans('currencyRateHistory.backend.table.created_at').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $currencyRateHistory->created_at }}</p>
	</div>
</div>
