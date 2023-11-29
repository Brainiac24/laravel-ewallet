<!-- NAME Field -->
<div class="form-group">
    {!! Form::label('name', trans('coordinatePointWorkday.backend.table.name').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
            <p class="form-control-static">{{ $coordinatePointWorkday->name }}</p>
	</div>
</div>
<!-- monday Field -->
<div class="form-group">
	{!! Form::label('monday', trans('coordinatePointWorkday.backend.table.monday').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $coordinatePointWorkday->monday }}</p>
	</div>
</div>
<!-- tuesday Field -->
<div class="form-group">
	{!! Form::label('tuesday', trans('coordinatePointWorkday.backend.table.tuesday').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $coordinatePointWorkday->tuesday }}</p>
	</div>
</div>
<!-- wednesday Field -->
<div class="form-group">
	{!! Form::label('wednesday', trans('coordinatePointWorkday.backend.table.wednesday').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $coordinatePointWorkday->wednesday }}</p>
	</div>
</div>
<!-- thursday Field -->
<div class="form-group">
	{!! Form::label('thursday', trans('coordinatePointWorkday.backend.table.thursday').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $coordinatePointWorkday->thursday }}</p>
	</div>
</div>
<!-- friday Field -->
<div class="form-group">
	{!! Form::label('friday', trans('coordinatePointWorkday.backend.table.friday').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $coordinatePointWorkday->friday }}</p>
	</div>
</div>
<!-- saturday Field -->
<div class="form-group">
	{!! Form::label('saturday', trans('coordinatePointWorkday.backend.table.saturday').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $coordinatePointWorkday->saturday }}</p>
	</div>
</div>
<!-- sunday Field -->
<div class="form-group">
	{!! Form::label('sunday', trans('coordinatePointWorkday.backend.table.sunday').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $coordinatePointWorkday->sunday }}</p>
	</div>
</div>

<div class="form-group">
	{!! Form::label('is_active', trans('coordinatePointWorkday.backend.table.is_active').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{trans('InterfaceTranses.is_active.'. $coordinatePointWorkday->is_active )}}</p>
	</div>
</div>

<!-- Created_at Field -->
<div class="form-group">
	{!! Form::label('created_at', trans('coordinatePointWorkday.backend.table.created_at').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $coordinatePointWorkday->created_at }}</p>
	</div>
</div>
<!-- updated_at Field -->
<div class="form-group">
	{!! Form::label('updated_at', trans('coordinatePointWorkday.backend.table.updated_at').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $coordinatePointWorkday->updated_at }}</p>
	</div>
</div>