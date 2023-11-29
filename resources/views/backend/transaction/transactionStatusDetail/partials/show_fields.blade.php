<!-- code Field -->
<div class="form-group">
    {!! Form::label('code', trans('gateways.backend.table.code').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
            <p class="form-control-static">{{ $transactionStatusDetail->code }}</p>
	</div>
</div>

<!-- name Field -->
<div class="form-group">
	{!! Form::label('name', trans('gateways.backend.table.name').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $transactionStatusDetail->name }}</p>
	</div>
</div>

<!-- params_json Field -->
<div class="form-group">
	{!! Form::label('params_json', trans('gateways.backend.table.params_json').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $transactionStatusDetail->color }}</p>
	</div>
</div>


<!-- created_at Field -->
<div class="form-group">
	{!! Form::label('created_at', trans('gateways.backend.table.created_at').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $transactionStatusDetail->created_at }}</p>
	</div>
</div>
<!-- updated_at Field -->
<div class="form-group">
	{!! Form::label('updated_at', trans('gateways.backend.table.updated_at').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $transactionStatusDetail->updated_at }}</p>
	</div>
</div>