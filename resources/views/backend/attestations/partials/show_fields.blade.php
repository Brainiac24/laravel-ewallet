<!-- CODE Field -->
<div class="form-group">
    {!! Form::label('code', trans('attestations.backend.table.code').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
            <p class="form-control-static">{{ $attestation->code }}</p>
	</div>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', trans('attestations.backend.table.name').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
            <p class="form-control-static">{{ $attestation->name }}</p>
	</div>
</div>

<!-- Day_limit Field -->
<div class="form-group">
	{!! Form::label('day_limit', trans('attestations.backend.table.day_limit').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $attestation->params_json['day']['limit'] }}</p>
	</div>
</div>

<!-- month_limit Field -->
<div class="form-group">
	{!! Form::label('week_limit', trans('attestations.backend.table.week_limit').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $attestation->params_json['week']['limit'] }}</p>
	</div>
</div>

<!-- month_limit Field -->
<div class="form-group">
	{!! Form::label('month_limit', trans('attestations.backend.table.month_limit').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $attestation->params_json['month']['limit'] }}</p>
	</div>
</div>

<!-- Created_at Field -->
<div class="form-group">
	{!! Form::label('created_at', trans('attestations.backend.table.created_at').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $attestation->created_at }}</p>
	</div>
</div>
<!-- updated_at Field -->
<div class="form-group">
	{!! Form::label('updated_at', trans('attestations.backend.table.updated_at').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $attestation->created_at }}</p>
	</div>
</div>