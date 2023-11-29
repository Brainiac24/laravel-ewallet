
<!-- NAME Field -->
<div class="form-group">
    {!! Form::label('name', trans('commission.backend.table.name').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
            <p class="form-control-static">{{ $commission->name }}</p>
	</div>
</div>
<!-- Created_at Field -->
<div class="form-group">
	{!! Form::label('created_at', trans('commission.backend.table.created_at').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $commission->created_at }}</p>
	</div>
</div>
<!-- updated_at Field -->
<div class="form-group">
	{!! Form::label('updated_at', trans('commission.backend.table.updated_at').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $commission->created_at }}</p>
	</div>
</div>