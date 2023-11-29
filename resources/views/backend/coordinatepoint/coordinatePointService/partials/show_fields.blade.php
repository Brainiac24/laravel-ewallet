<!-- NAME Field -->
<div class="form-group">
    {!! Form::label('name', trans('coordinatePointService.backend.table.name').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
            <p class="form-control-static">{{ $coordinatePointService->name }}</p>
	</div>
</div>
<!-- position Field -->
<div class="form-group">
	{!! Form::label('position', trans('coordinatePointService.backend.table.position').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $coordinatePointService->position }}</p>
	</div>
</div>

<div class="form-group">
	{!! Form::label('is_show_for_filter', trans('coordinatePointService.backend.table.is_show_for_filter').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{trans('InterfaceTranses.verified.'. $coordinatePointService->is_show_for_filter )}}</p>
	</div>
</div>

<div class="form-group">
	{!! Form::label('is_active', trans('coordinatePointService.backend.table.is_active').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{trans('InterfaceTranses.is_active.'. $coordinatePointService->is_active )}}</p>
	</div>
</div>

<!-- Created_at Field -->
<div class="form-group">
	{!! Form::label('created_at', trans('coordinatePointService.backend.table.created_at').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $coordinatePointService->created_at }}</p>
	</div>
</div>
<!-- updated_at Field -->
<div class="form-group">
	{!! Form::label('updated_at', trans('coordinatePointService.backend.table.updated_at').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $coordinatePointService->updated_at }}</p>
	</div>
</div>