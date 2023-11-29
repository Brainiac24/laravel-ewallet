<!-- code Field -->
<div class="form-group">
    {!! Form::label('id', trans('cashbackItem.backend.id').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
            <p class="form-control-static">{{ $data->id }}</p>
	</div>
</div>

<div class="form-group">
	{!! Form::label('name', trans('cashbackItem.backend.name').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $data->name }}</p>
	</div>
</div>


<!-- params_json Field -->
<div class="form-group">
	{!! Form::label('min', trans('cashbackItem.backend.min').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $data->min }}</p>
	</div>
</div>

<div class="form-group">
	{!! Form::label('max', trans('cashbackItem.backend.max').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $data->max }}</p>
	</div>
</div>

<div class="form-group">
	{!! Form::label('value', trans('cashbackItem.backend.value').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $data->value }}</p>
	</div>
</div>

<div class="form-group">
	{!! Form::label('is_percentage', trans('cashbackItem.backend.is_percentage').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $data->is_percentage }}</p>
	</div>
</div>

<div class="form-group">
	{!! Form::label('cashback_id', trans('cashbackItem.backend.cashback_id').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $data->cashback->name }}</p>
	</div>
</div>

<!-- is_active Field -->
<div class="form-group">
	{!! Form::label('is_active', trans('cashback.backend.is_active').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ trans('InterfaceTranses.enabled.'.$data->is_active) }}</p>
	</div>
</div>

<!-- created_at Field -->
<div class="form-group">
	{!! Form::label('created_at', trans('cashback.backend.created_at').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $data->created_at }}</p>
	</div>
</div>
<!-- updated_at Field -->
<div class="form-group">
	{!! Form::label('updated_at', trans('cashback.backend.updated_at').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $data->updated_at }}</p>
	</div>
</div>