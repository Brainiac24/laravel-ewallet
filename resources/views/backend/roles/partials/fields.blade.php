<!-- Name Field -->
<div class="form-group required">
    {!! Form::label('name', trans('roles.backend.code').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- Display Name Field -->
<div class="form-group required">
    {!! Form::label('display_name', trans('roles.backend.display_name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('display_name', null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', trans('roles.backend.description').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- Permission Field -->
<div class="form-group required">
    {!! Form::label('permission', trans('roles.backend.permission').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('permission', $perms, Route::is('admin.roles.create') ? null : $selectedPerms, ['name' => 'permission_ids[]', 'id' => 'select2_perms', 'class' => 'form-control select2 ', 'data-placeholder' => 'Выберите доступы', 'multiple','style'=>'width: 100%;']) !!}
    </div>
</div>


