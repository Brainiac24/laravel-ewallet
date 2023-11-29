<!-- code Field -->
<div class="form-group">
    {!! Form::label('id', trans('cashback.backend.id').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
            <p class="form-control-static">{{ $data->id }}</p>
	</div>
</div>

<div class="form-group">
	{!! Form::label('name', trans('cashback.backend.name').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $data->name }}</p>
	</div>
</div>


<!-- params_json Field -->
<div class="form-group">
	{!! Form::label('start_date', trans('cashback.backend.start_date').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ empty($data->start_date)?null:\Carbon\Carbon::parse($data->start_date)->format("d.m.Y H:i:s") }}</p>
	</div>
</div>

<div class="form-group">
	{!! Form::label('end_date', trans('cashback.backend.end_date').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ empty($data->end_date)?null:\Carbon\Carbon::parse($data->end_date)->format("d.m.Y H:i:s") }}</p>
	</div>
</div>

{{--<div class="form-group">--}}
	{{--{!! Form::label('is_popular', trans('cashback.backend.is_popular').':', ['class' => 'control-label col-sm-2']) !!}--}}
	{{--<div class='col-sm-9'>--}}
		{{--<p class="form-control-static">{{ trans('InterfaceTranses.yesno.'.$data->is_popular) }}</p>--}}
	{{--</div>--}}
{{--</div>--}}

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
		<p class="form-control-static">{{ empty($data->created_at)?null:\Carbon\Carbon::parse($data->created_at)->format("d.m.Y H:i:s")}}</p>
	</div>
</div>
<!-- updated_at Field -->
<div class="form-group">
	{!! Form::label('updated_at', trans('cashback.backend.updated_at').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ empty($data->updated_at)?null:\Carbon\Carbon::parse($data->updated_at)->format("d.m.Y H:i:s")}}</p>
	</div>
</div>