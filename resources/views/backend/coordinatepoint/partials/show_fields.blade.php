<!-- code Field -->
{{--<div class="form-group">--}}
    {{--{!! Form::label('code', trans('gateways.backend.table.code').':', ['class' => 'control-label col-sm-2']) !!}--}}
	{{--<div class='col-sm-9'>--}}
            {{--<p class="form-control-static">{{ $coordinatePoint->id }}</p>--}}
	{{--</div>--}}
{{--</div>--}}

<!-- name Field -->
<div class="form-group">
	{!! Form::label('name', trans('coordinatePoint.backend.table.name').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $coordinatePoint->name }}</p>
	</div>
</div>

<div class="form-group">
	{!! Form::label('name', trans('coordinatePoint.backend.table.address').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $coordinatePoint->address }}</p>
	</div>
</div>

<div class="form-group">
	{!! Form::label('longitude', trans('coordinatePoint.backend.table.longitude').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $coordinatePoint->longitude }}</p>
	</div>
</div>

<div class="form-group">
	{!! Form::label('latitude', trans('coordinatePoint.backend.table.latitude').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $coordinatePoint->latitude }}</p>
	</div>
</div>

<div class="form-group">
	{!! Form::label('object_type', trans('coordinatePoint.backend.table.object_type').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $coordinatePoint->object_type }}</p>
	</div>
</div>

<div class="form-group">
	{!! Form::label('coordinate_point_type_id', trans('coordinatePoint.backend.table.coordinate_point_type_id').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $coordinatePoint->coordinate_point_type->name??'' }}</p>
	</div>
</div>

<div class="form-group">
	{!! Form::label('coordinate_point_workday_id', trans('coordinatePoint.backend.table.coordinate_point_workday_id').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $coordinatePoint->coordinate_point_workday->name??'' }}</p>
	</div>
</div>

<div class="form-group">
	{!! Form::label('coordinate_point_city', trans('coordinatePoint.backend.table.coordinate_point_city_id').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $coordinatePoint->coordinate_point_city->city->name }}</p>
	</div>
</div>

<div class="form-group">
	{!! Form::label('merchant_id', trans('coordinatePoint.backend.table.merchant_id').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $coordinatePoint->merchant->name??'' }}</p>
	</div>
</div>

<div class="form-group">
	{!! Form::label('is_active', trans('coordinatePoint.backend.table.is_active').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ trans('InterfaceTranses.enabled.'.$coordinatePoint->is_active) }}</p>
	</div>
</div>


<div class="form-group">
	{!! Form::label('updated_at', trans('coordinatePoint.backend.table.updated_at').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $coordinatePoint->updated_at }}</p>
	</div>
</div>

<div class="form-group">
	{!! Form::label('created_at', trans('coordinatePoint.backend.table.created_at').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $coordinatePoint->created_at }}</p>
	</div>
</div>

</div>
