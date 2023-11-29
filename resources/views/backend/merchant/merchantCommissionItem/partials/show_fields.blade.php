<!-- code Field -->
<div class="form-group">
    {!! Form::label('id', trans('merchantCommissionItem.backend.id').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
            <p class="form-control-static">{{ $data->id }}</p>
	</div>
</div>

<!-- name Field -->
<div class="form-group">
	{!! Form::label('name', trans('merchantCommissionItem.backend.name').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $data->name }}</p>
	</div>
</div>

<div class="form-group">
	{!! Form::label('min', trans('merchantCommissionItem.backend.min').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $data->min }}</p>
	</div>
</div>

<div class="form-group">
	{!! Form::label('max', trans('merchantCommissionItem.backend.max').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $data->max ?? '' }}</p>
	</div>
</div>

<div class="form-group">
	{!! Form::label('value', trans('merchantCommissionItem.backend.value').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $data->value }}</p>
	</div>
</div>

<div class="form-group">
	{!! Form::label('is_percentage', trans('merchantCommissionItem.backend.is_percentage').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ trans('InterfaceTranses.yesno.'.$data->is_percentage) }}</p>
	</div>
</div>

<div class="form-group">
	{!! Form::label('merchant_commission_id', trans('merchantCommissionItem.backend.merchant_commission_id').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $data->merchant_commission->name ?? ''}}</p>
	</div>
</div>

<!-- is_active Field -->
<div class="form-group">
	{!! Form::label('is_active', trans('merchantItem.backend.is_active').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ trans('InterfaceTranses.enabled.'.$data->is_active) }}</p>
	</div>
</div>

<!-- created_at Field -->
<div class="form-group">
	{!! Form::label('created_at', trans('merchantItem.backend.created_at').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $data->created_at }}</p>
	</div>
</div>
<!-- updated_at Field -->
<div class="form-group">
	{!! Form::label('updated_at', trans('merchantItem.backend.updated_at').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $data->updated_at }}</p>
	</div>
</div>
