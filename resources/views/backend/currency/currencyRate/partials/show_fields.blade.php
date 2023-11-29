<!-- value_buy Field -->
<div class="form-group">
    {!! Form::label('value_buy', trans('currencyRate.backend.table.value_buy').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
            <p class="form-control-static">{{ $currencyRate->value_buy }}</p>
	</div>
</div>
<!-- value_sell Field -->
<div class="form-group">
	{!! Form::label('value_sell', trans('currencyRate.backend.table.value_sell').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $currencyRate->value_sell }}</p>
	</div>
</div>
<!-- currency_id Field -->
<div class="form-group">
	{!! Form::label('currency_id', trans('currencyRate.backend.table.currency_id').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $currencyRate->currency->name }}</p>
	</div>
</div>
<!-- currency_id Field -->
<div class="form-group">
	{!! Form::label('currency_rate_category_name', trans('currencyRate.backend.table.currency_rate_category_name').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $currencyRate->currency_rate_category->name }}</p>
	</div>
</div>

<!-- updated_at Field -->
<div class="form-group">
	{!! Form::label('updated_at', trans('currencyRate.backend.table.updated_at').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $currencyRate->updated_at }}</p>
	</div>
</div>
<!-- created_at Field -->
<div class="form-group">
	{!! Form::label('created_at', trans('currencyRate.backend.table.created_at').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $currencyRate->created_at }}</p>
	</div>
</div>