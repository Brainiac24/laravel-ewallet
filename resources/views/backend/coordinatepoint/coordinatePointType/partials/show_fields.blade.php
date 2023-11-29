<!-- NAME Field -->
<div class="form-group">
    {!! Form::label('name', trans('coordinatePointType.backend.table.name').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
            <p class="form-control-static">{{ $coordinatePointType->name }}</p>
	</div>
</div>

<!-- code Field -->
<div class="form-group">
    {!! Form::label('code', trans('coordinatePointType.backend.table.code').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
            <p class="form-control-static">{{ $coordinatePointType->code }}</p>
	</div>
</div>
<!-- coordinate_point_workday Field -->
<div class="form-group">
    {!! Form::label('coordinate_point_workday', trans('coordinatePointType.backend.table.coordinate_point_workday_id').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
            <p class="form-control-static">{{ $coordinatePointType->coordinate_point_workday->name }}</p>
	</div>
</div>
<!-- position Field -->
<div class="form-group">
	{!! Form::label('position', trans('coordinatePointType.backend.table.position').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $coordinatePointType->position }}</p>
	</div>
</div>

<div class="form-group">
	{!! Form::label('is_show_for_filter', trans('coordinatePointType.backend.table.is_show_for_filter').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{trans('InterfaceTranses.verified.'. $coordinatePointType->is_show_for_filter )}}</p>
	</div>
</div>

<div class="form-group">
	{!! Form::label('is_active', trans('coordinatePointType.backend.table.is_active').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{trans('InterfaceTranses.is_active.'. $coordinatePointType->is_active )}}</p>
	</div>
</div>

<!-- Created_at Field -->
<div class="form-group">
	{!! Form::label('created_at', trans('coordinatePointType.backend.table.created_at').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $coordinatePointType->created_at }}</p>
	</div>
</div>
<!-- updated_at Field -->
<div class="form-group">
	{!! Form::label('updated_at', trans('coordinatePointType.backend.table.updated_at').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $coordinatePointType->updated_at }}</p>
	</div>
</div>