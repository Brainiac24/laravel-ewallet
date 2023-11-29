<!-- code Field -->
<div class="form-group">
    {!! Form::label('id', trans('purpose.backend.table.id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->id }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('code', trans('purpose.backend.table.code').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->code }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('code', trans('purpose.backend.table.code_map').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->code_map }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('name', trans('purpose.backend.table.name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->name }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('name', trans('purpose.backend.table.desc').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->desc }}</p>
    </div>
</div>

<!-- is_active Field -->
<div class="form-group">
    {!! Form::label('is_active', trans('purpose.backend.table.is_active').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ trans('InterfaceTranses.is_active.'.$data->is_active) }}</p>
    </div>
</div>

<!-- purpose_type_name Field -->
<div class="form-group">
    {!! Form::label('purpose_type_name', trans('purpose.backend.table.purpose_type_name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{$data->purpose_type->name }}</p>
    </div>
</div>

<!-- created_at Field -->
<div class="form-group">
    {!! Form::label('created_at', trans('purpose.backend.table.created_at').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->created_at }}</p>
    </div>
</div>
<!-- updated_at Field -->
<div class="form-group">
    {!! Form::label('updated_at', trans('purpose.backend.table.updated_at').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->updated_at }}</p>
    </div>
</div>