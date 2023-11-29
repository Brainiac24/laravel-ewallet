<!-- service_id Field -->
<div class="form-group">
	{!! Form::label('service_id', trans('userServiceLimit.backend.table.name').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $userServiceLimit->service->service_limit->name}}</p>
	</div>
</div>
<div class="form-group">
	{!! Form::label('service_id', trans('userServiceLimit.backend.table.service_id').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $userServiceLimit->service->name}}</p>
	</div>
</div>
<!-- user_id Field -->
<div class="form-group">
	{!! Form::label('user_id', trans('userServiceLimit.backend.table.user_id').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $userServiceLimit->user->msisdn }}</p>
	</div>
</div>
<!-- params_json Field -->
<div class="form-group">
	{!! Form::label('params_json', trans('userServiceLimit.backend.table.params_json').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="{{ $userServiceLimit->params_json==null ?: 'json-params' }}">{{ json_encode($userServiceLimit->params_json, JSON_UNESCAPED_UNICODE) }}</p>
	</div>
</div>
<!-- extend_params_json Field -->
<div class="form-group">
	{!! Form::label('extend_params_json', trans('userServiceLimit.backend.table.extend_params_json').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="{{ $userServiceLimit->extend_params_json==null ?: 'json-params' }}">{{ json_encode($userServiceLimit->extend_params_json, JSON_UNESCAPED_UNICODE) }}</p>
	</div>
</div>

<div class="form-group">
	{!! Form::label('created_at', trans('userServiceLimit.backend.table.created_at').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $userServiceLimit->created_at }}</p>
	</div>
</div>
<div class="form-group">
	{!! Form::label('updated_at', trans('userServiceLimit.backend.table.updated_at').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $userServiceLimit->updated_at }}</p>
	</div>
</div>