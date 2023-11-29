<!-- code Field -->
<div class="form-group">
    {!! Form::label('code', trans('color.backend.table.code').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $color->code }}</p>
    </div>
</div>
<!-- code Map -->
<div class="form-group">
    {!! Form::label('color', trans('color.backend.table.color').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $color->color }}</p>
    </div>
</div>

<!-- is_active Field -->
<div class="form-group">
    {!! Form::label('is_active', trans('color.backend.table.is_active').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ trans('InterfaceTranses.enabled.'.$color->is_active) }}</p>
    </div>
</div>


<!-- created_at Field -->
<div class="form-group">
    {!! Form::label('created_at', trans('color.backend.table.created_at').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $color->created_at }}</p>
    </div>
</div>
<!-- updated_at Field -->
<div class="form-group">
    {!! Form::label('updated_at', trans('color.backend.table.updated_at').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $color->updated_at }}</p>
    </div>
</div>