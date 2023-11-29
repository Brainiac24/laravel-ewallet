<!-- NAME Field -->
<div class="form-group">
    {!! Form::label('name', trans('serviceworkdays.backend.table.code').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
            <p class="form-control-static">{{ $serviceWorkDays->name }}</p>
	</div>
</div>
<!-- monday Field -->
<div class="form-group">
	{!! Form::label('monday', trans('serviceworkdays.backend.table.monday').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $serviceWorkDays->monday }}</p>
	</div>
</div>
<!-- tuesday Field -->
<div class="form-group">
	{!! Form::label('tuesday', trans('serviceworkdays.backend.table.tuesday').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $serviceWorkDays->tuesday }}</p>
	</div>
</div>
<!-- wednesday Field -->
<div class="form-group">
	{!! Form::label('wednesday', trans('serviceworkdays.backend.table.wednesday').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $serviceWorkDays->wednesday }}</p>
	</div>
</div>
<!-- thursday Field -->
<div class="form-group">
	{!! Form::label('thursday', trans('serviceworkdays.backend.table.thursday').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $serviceWorkDays->thursday }}</p>
	</div>
</div>
<!-- friday Field -->
<div class="form-group">
	{!! Form::label('friday', trans('serviceworkdays.backend.table.friday').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $serviceWorkDays->friday }}</p>
	</div>
</div>
<!-- saturday Field -->
<div class="form-group">
	{!! Form::label('saturday', trans('serviceworkdays.backend.table.saturday').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $serviceWorkDays->saturday }}</p>
	</div>
</div>
<!-- sunday Field -->
<div class="form-group">
	{!! Form::label('sunday', trans('serviceworkdays.backend.table.sunday').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $serviceWorkDays->sunday }}</p>
	</div>
</div>

<!-- Created_at Field -->
<div class="form-group">
	{!! Form::label('created_at', trans('serviceworkdays.backend.table.created_at').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $serviceWorkDays->created_at }}</p>
	</div>
</div>
<!-- updated_at Field -->
<div class="form-group">
	{!! Form::label('updated_at', trans('serviceworkdays.backend.table.updated_at').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $serviceWorkDays->created_at }}</p>
	</div>
</div>