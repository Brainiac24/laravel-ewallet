<!-- code Field -->
<div class="form-group">
    {!! Form::label('code', trans('transactionSyncStatus.backend.table.code').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->code }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('code_map', trans('transactionSyncStatus.backend.table.code_map').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->code_map }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('name', trans('transactionSyncStatus.backend.table.name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->name }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('desc', trans('transactionSyncStatus.backend.table.desc').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->desc }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('is_active', trans('orderStatus.backend.table.is_active').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ trans('InterfaceTranses.is_active.'.$data->is_active) }}</p>
    </div>
</div>

<!-- created_at Field -->
<div class="form-group">
    {!! Form::label('created_at', trans('transactionSyncStatus.backend.table.created_at').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->created_at }}</p>
    </div>
</div>
<!-- updated_at Field -->
<div class="form-group">
    {!! Form::label('updated_at', trans('transactionSyncStatus.backend.table.updated_at').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->updated_at }}</p>
    </div>
</div>