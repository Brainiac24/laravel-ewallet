<!-- code Field -->
<div class="form-group">
    {!! Form::label('code', trans('accountType.backend.table.code').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
            <p class="form-control-static">{{ $accountTypeDetail->code }}</p>
	</div>
</div>
<!-- from_account_id Field -->
<div class="form-group">
	{!! Form::label('from_account_id', trans('accountType.backend.table.name').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $accountTypeDetail->name }}</p>
	</div>
</div>
<!-- to_account_id Field -->
<div class="form-group">
	{!! Form::label('to_account_id', trans('accountType.backend.table.gateway').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $accountTypeDetail->accountType->name }}</p>
	</div>
</div>
<!-- created_at Field -->
<div class="form-group">
	{!! Form::label('created_at', trans('accountType.backend.table.created_at').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $accountTypeDetail->created_at }}</p>
	</div>
</div>
<!-- updated_at Field -->
<div class="form-group">
	{!! Form::label('updated_at', trans('accountType.backend.table.updated_at').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $accountTypeDetail->updated_at }}</p>
	</div>
</div>