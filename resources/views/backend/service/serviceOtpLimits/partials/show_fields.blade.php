<!-- CODE Field -->
<div class="form-group">
	{!! Form::label('id', 'ID:', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $serviceOtpLimits->id }}</p>
	</div>
</div>

<div class="form-group">
    {!! Form::label('code', trans('serviceOtpLimits.backend.table.code').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
            <p class="form-control-static">{{ $serviceOtpLimits->code }}</p>
	</div>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', trans('serviceOtpLimits.backend.table.name').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
            <p class="form-control-static">{{ $serviceOtpLimits->name ?? "" }}</p>
	</div>
</div>

<div class="form-group">
	{!! Form::label('params_json', trans('serviceOtpLimits.backend.table.params_json').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="{{ $serviceOtpLimits->params_json==null ?: 'json-params' }}">{{ json_encode($serviceOtpLimits->params_json, JSON_UNESCAPED_UNICODE) }}</p>
	</div>
</div>

<!-- Created_at Field -->
<div class="form-group">
	{!! Form::label('created_at', trans('serviceOtpLimits.backend.table.created_at').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $serviceOtpLimits->created_at }}</p>
	</div>
</div>
<!-- updated_at Field -->
<div class="form-group">
	{!! Form::label('updated_at', trans('serviceOtpLimits.backend.table.updated_at').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $serviceOtpLimits->created_at }}</p>
	</div>
</div>