<!-- id Field -->
<div class="form-group">
	{!! Form::label('code', trans('userHistory.backend.table.id').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $userHistory->id }}</p>
	</div>
</div>
<!-- event_id Field -->
<div class="form-group">
	{!! Form::label('event_id', trans('userHistory.backend.table.event_id').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $userHistory->user_events->name }}</p>
	</div>
</div>

<!-- old_params_json Field -->
<div class="form-group">
	{!! Form::label('old_params_json', trans('userHistory.backend.table.old_params_json').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ json_encode($userHistory->old_params_json) }}</p>
	</div>
</div>

<!-- new_params_json Field -->
<div class="form-group">
	{!! Form::label('new_params_json', trans('userHistory.backend.table.new_params_json').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ json_encode($userHistory->new_params_json) }}</p>
	</div>
</div>
<!-- entity_type Field -->
<div class="form-group">
	{!! Form::label('entity_type', trans('userHistory.backend.table.entity_type').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $userHistory->entity_type }}</p>
	</div>
</div>

<!-- entity_id Field -->
<div class="form-group">
	{!! Form::label('entity_id', trans('userHistory.backend.table.entity_id').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $userHistory->entity_id }}</p>
	</div>
</div>
<!-- ip Field -->
<div class="form-group">
	{!! Form::label('ip', trans('userHistory.backend.table.ip').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $userHistory->ip }}</p>
	</div>
</div>

<!-- description Field -->
<div class="form-group">
	{!! Form::label('description', trans('userHistory.backend.table.description').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $userHistory->description }}</p>
	</div>
</div>

<!-- created_at Field -->
<div class="form-group">
	{!! Form::label('created_at', trans('userHistory.backend.table.created_at').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $userHistory->created_at }}</p>
	</div>
</div>

<!-- updated_at Field -->
<div class="form-group">
	{!! Form::label('updated_at', trans('userHistory.backend.table.updated_at').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $userHistory->updated_at }}</p>
	</div>
</div>