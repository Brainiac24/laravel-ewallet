<!-- code Field -->
<div class="form-group">
    {!! Form::label('code', trans('currency.backend.table.code').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
            <p class="form-control-static">{{ $currency->code }}</p>
	</div>
</div>

<!-- name Field -->
<div class="form-group">
	{!! Form::label('name', trans('currency.backend.table.name').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $currency->name }}</p>
	</div>
</div>
<!-- short_name Field -->
<div class="form-group">
	{!! Form::label('short_name', trans('currency.backend.table.short_name').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $currency->short_name }}</p>
	</div>
</div>
<!-- iso_name Field -->
<div class="form-group">
	{!! Form::label('iso_name', trans('currency.backend.table.iso_name').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $currency->iso_name }}</p>
	</div>
</div>
<!-- symbol_left Field -->
<div class="form-group">
	{!! Form::label('symbol_left', trans('currency.backend.table.symbol_left').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $currency->symbol_left }}</p>
	</div>
</div>
<!-- symbol_right Field -->
<div class="form-group">
	{!! Form::label('symbol_right', trans('currency.backend.table.symbol_right').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $currency->symbol_right }}</p>
	</div>
</div>
<!-- is_primary Field -->
<div class="form-group">
	{!! Form::label('is_primary', trans('currency.backend.table.is_primary').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ trans('InterfaceTranses.yesno.'.$currency->is_primary) }}</p>
	</div>
</div>
<!-- is_active Field -->
<div class="form-group">
	{!! Form::label('is_active', trans('currency.backend.table.is_active').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ trans('InterfaceTranses.enabled.'.$currency->is_active) }}</p>
	</div>
</div>

<!-- created_at Field -->
<div class="form-group">
	{!! Form::label('created_at', trans('gateways.backend.table.created_at').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $currency->created_at }}</p>
	</div>
</div>
<!-- updated_at Field -->
<div class="form-group">
	{!! Form::label('updated_at', trans('gateways.backend.table.updated_at').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $currency->updated_at }}</p>
	</div>
</div>