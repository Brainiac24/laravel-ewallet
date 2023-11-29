<div class="form-group">
    {!! Form::label('id', trans('cashbackType.backend.table.id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->id }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('code', trans('cashbackType.backend.table.code').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->code }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('name', trans('cashbackType.backend.table.name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->name }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('is_active', trans('cashbackType.backend.table.is_active').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{trans('InterfaceTranses.is_active.'. $data->is_active )}}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('created_at', trans('cashbackType.backend.table.created_at').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->created_at }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('updated_at', trans('cashbackType.backend.table.updated_at').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->updated_at }}</p>
    </div>
</div>