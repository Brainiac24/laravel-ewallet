<!-- code Field -->
<div class="form-group">
    {!! Form::label('code', trans('transferList.backend.table.code').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->code }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('code_map', trans('transferList.backend.table.code_map').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->code_map }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('name', trans('transferList.backend.table.name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->name }}</p>
    </div>
</div>


<div class="form-group">
    {!! Form::label('icon_url', trans('transferList.backend.table.icon_url').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->icon_url }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('desc', trans('transferList.backend.table.desc').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->desc }}</p>
    </div>
</div>

<!-- created_at Field -->
<div class="form-group">
    {!! Form::label('created_at', trans('transferList.backend.table.created_at').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->created_at }}</p>
    </div>
</div>
<!-- updated_at Field -->
<div class="form-group">
    {!! Form::label('updated_at', trans('transferList.backend.table.updated_at').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->updated_at }}</p>
    </div>
</div>