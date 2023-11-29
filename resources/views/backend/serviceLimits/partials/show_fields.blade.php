<!-- CODE Field -->
<div class="form-group">
    {!! Form::label('code', trans('serviceLimits.backend.table.code').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
            <p class="form-control-static">{{ $serviceLimit->code }}</p>
	</div>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', trans('serviceLimits.backend.table.name').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
            <p class="form-control-static">{{ $serviceLimit->name }}</p>
	</div>
</div>

<div class="form-group">
	{!! Form::label('params_json', trans('serviceLimits.backend.table.params_json').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="{{ $serviceLimit->params_json==null ?: 'json-params' }}">{{ json_encode($serviceLimit->params_json, JSON_UNESCAPED_UNICODE) }}</p>
	</div>
</div>

<div class="form-group">
	{!! Form::label('extend_params_json', trans('service.backend.extend_params_json').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="{{ $serviceLimit->extend_params_json==null ?: 'json-params' }}">{{ json_encode($serviceLimit->extend_params_json, JSON_UNESCAPED_UNICODE) }}</p>
	</div>
</div>

<!-- Created_at Field -->
<div class="form-group">
	{!! Form::label('created_at', trans('serviceLimits.backend.table.created_at').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $serviceLimit->created_at }}</p>
	</div>
</div>
<!-- updated_at Field -->
<div class="form-group">
	{!! Form::label('updated_at', trans('serviceLimits.backend.table.updated_at').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $serviceLimit->created_at }}</p>
	</div>
</div>