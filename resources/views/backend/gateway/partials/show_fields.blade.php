<!-- code Field -->
<div class="form-group">
    {!! Form::label('code', trans('gateways.backend.table.code').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
            <p class="form-control-static">{{ $gateway->code }}</p>
	</div>
</div>

<!-- name Field -->
<div class="form-group">
	{!! Form::label('name', trans('gateways.backend.table.name').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $gateway->name }}</p>
	</div>
</div>

<!-- params_json Field -->
<div class="form-group">
	{!! Form::label('params_json', trans('gateways.backend.table.params_json').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $gateway->params_json }}</p>
	</div>
</div>

<!-- is_active Field -->
<div class="form-group">
	{!! Form::label('is_active', trans('gateways.backend.table.is_active').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ trans('InterfaceTranses.enabled.'.$gateway->is_active) }}</p>
	</div>
</div>

<!-- is_enabled_for_accounts Field -->
<div class="form-group">
	{!! Form::label('is_enabled_for_account', trans('gateways.backend.table.is_enabled_for_account').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ trans('InterfaceTranses.enabled.'.$gateway->is_enabled_for_account) }}</p>
	</div>
</div>


<!-- is_enabled_for_service Field -->
<div class="form-group">
	{!! Form::label('is_enabled_for_service', trans('gateways.backend.table.is_enabled_for_service').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ trans('InterfaceTranses.enabled.'.$gateway->is_enabled_for_service) }}</p>
	</div>
</div>



<!-- created_at Field -->
<div class="form-group">
	{!! Form::label('created_at', trans('gateways.backend.table.created_at').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $gateway->created_at }}</p>
	</div>
</div>
<!-- updated_at Field -->
<div class="form-group">
	{!! Form::label('updated_at', trans('gateways.backend.table.updated_at').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $gateway->updated_at }}</p>
	</div>
</div>