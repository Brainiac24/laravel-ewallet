<!-- code Field -->
<div class="form-group">
    {!! Form::label('code', trans('accountStatus.backend.table.code_map').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $accountStatus->code_map }}</p>
    </div>
</div>
<!-- from_account_id Field -->
<div class="form-group">
    {!! Form::label('name', trans('accountStatus.backend.table.name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $accountStatus->name }}</p>
    </div>
</div>
<!-- to_account_id Field -->
<div class="form-group">
    {!! Form::label('is_active', trans('accountStatus.backend.table.is_active').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ trans('InterfaceTranses.is_active.'.(int)$accountStatus->is_active)  }}</p>
    </div>
</div>
<!-- created_at Field -->
<div class="form-group">
    {!! Form::label('created_at', trans('accountStatus.backend.table.created_at').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $accountStatus->created_at }}</p>
    </div>
</div>
<!-- updated_at Field -->
<div class="form-group">
    {!! Form::label('updated_at', trans('accountStatus.backend.table.updated_at').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $accountStatus->updated_at }}</p>
    </div>
</div>