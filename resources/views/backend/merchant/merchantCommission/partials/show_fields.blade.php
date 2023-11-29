<!-- code Field -->
<div class="form-group">
    {!! Form::label('id', trans('merchantCommission.backend.id').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
            <p class="form-control-static">{{ $data->id }}</p>
	</div>
</div>

<div class="form-group">
	{!! Form::label('name', trans('merchantCommission.backend.name').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $data->name }}</p>
	</div>
</div>

<div class="form-group">
	{!! Form::label('start_date', trans('merchantCommission.backend.start_date').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $data->start_date }}</p>
	</div>
</div>

<div class="form-group">
	{!! Form::label('end_date', trans('merchantCommission.backend.end_date').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $data->end_date }}</p>
	</div>
</div>

<!-- is_active Field -->
<div class="form-group">
	{!! Form::label('is_active', trans('merchantCommission.backend.is_active').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ trans('InterfaceTranses.enabled.'.$data->is_active) }}</p>
	</div>
</div>

<!-- created_at Field -->
<div class="form-group">
	{!! Form::label('created_at', trans('merchantCommission.backend.created_at').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $data->created_at }}</p>
	</div>
</div>
<!-- updated_at Field -->
<div class="form-group">
	{!! Form::label('updated_at', trans('merchantCommission.backend.updated_at').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $data->updated_at }}</p>
	</div>
</div>