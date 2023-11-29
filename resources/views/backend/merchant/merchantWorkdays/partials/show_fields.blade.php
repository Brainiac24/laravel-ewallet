<div class="form-group">
	{!! Form::label('ID', 'ID:', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $data->id }}</p>
	</div>
</div>
<!-- NAME Field -->
<div class="form-group">
    {!! Form::label('name', trans('merchantWorkdays.backend.table.name').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
            <p class="form-control-static">{{ $data->name }}</p>
	</div>
</div>
<!-- monday Field -->
<div class="form-group">
	{!! Form::label('monday', trans('merchantWorkdays.backend.table.monday').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $data->monday }}</p>
	</div>
</div>
<!-- tuesday Field -->
<div class="form-group">
	{!! Form::label('tuesday', trans('merchantWorkdays.backend.table.tuesday').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $data->tuesday }}</p>
	</div>
</div>
<!-- wednesday Field -->
<div class="form-group">
	{!! Form::label('wednesday', trans('merchantWorkdays.backend.table.wednesday').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $data->wednesday }}</p>
	</div>
</div>
<!-- thursday Field -->
<div class="form-group">
	{!! Form::label('thursday', trans('merchantWorkdays.backend.table.thursday').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $data->thursday }}</p>
	</div>
</div>
<!-- friday Field -->
<div class="form-group">
	{!! Form::label('friday', trans('merchantWorkdays.backend.table.friday').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $data->friday }}</p>
	</div>
</div>
<!-- saturday Field -->
<div class="form-group">
	{!! Form::label('saturday', trans('merchantWorkdays.backend.table.saturday').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $data->saturday }}</p>
	</div>
</div>
<!-- sunday Field -->
<div class="form-group">
	{!! Form::label('sunday', trans('merchantWorkdays.backend.table.sunday').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $data->sunday }}</p>
	</div>
</div>

<!-- Created_at Field -->
<div class="form-group">
	{!! Form::label('created_at', trans('merchantWorkdays.backend.table.created_at').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $data->created_at }}</p>
	</div>
</div>
<!-- updated_at Field -->
<div class="form-group">
	{!! Form::label('updated_at', trans('merchantWorkdays.backend.table.updated_at').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $data->created_at }}</p>
	</div>
</div>