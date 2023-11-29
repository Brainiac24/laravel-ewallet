<!-- code Field -->
<div class="form-group">
    {!! Form::label('code', trans('category.backend.table.code').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
            <p class="form-control-static">{{ $categoryRepository->code }}</p>
	</div>
</div>

<!-- name Field -->
<div class="form-group">
	{!! Form::label('name', trans('category.backend.table.name').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $categoryRepository->name }}</p>
	</div>
</div>


<!-- code Field -->
<div class="form-group">
	{!! Form::label('parent_id', trans('category.backend.table.parent_id').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $categoryList->name }}</p>
	</div>
</div>

<!-- code Field -->
<div class="form-group">
	{!! Form::label('is_active', trans('category.backend.table.is_active').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ trans('InterfaceTranses.is_enabled.'.$categoryRepository->is_active) }}</p>
	</div>
</div>


<!-- code Field -->
<div class="form-group">
	{!! Form::label('position', trans('category.backend.table.position').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
		<p class="form-control-static">{{ $categoryRepository->position }}</p>
	</div>
</div>
