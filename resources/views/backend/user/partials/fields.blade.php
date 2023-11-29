<!-- Code Field -->
<div class="form-group required">
    {!! Form::label('username', trans('users.backend.table.username').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('username', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group required">
    {!! Form::label('password', trans('users.backend.table.password').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::password('password', ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group required">
    {!! Form::label('password_confirmation', trans('users.backend.table.password_confirmation').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group required">
    {!! Form::label('first_name', trans('users.backend.table.first_name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group required">
    {!! Form::label('middle_name', trans('users.backend.table.middle_name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('middle_name', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('last_name', trans('users.backend.table.last_name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- Permission Field -->
<div class="form-group required">
    {!! Form::label('roles', trans('roles.backend.roles').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('roles', $roles, Route::is('admin.users.create') ? null : $selectedRoles, ['name' => 'roles_id[]', 'id' => 'select2_perms', 'class' => 'form-control select2 ', 'data-placeholder' => 'Выберите роли', 'multiple']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('branches', trans('users.backend.branches').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('branches', $branches, Route::is('admin.users.create') ? null : $selectedBranches, ['name' => 'branches_id[]', 'id' => 'select2_perms', 'class' => 'form-control select2 ', 'data-placeholder' => 'Выберите филиалы', 'multiple']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('is_active', trans('users.backend.is_active').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('is_active', trans('InterfaceTranses.is_active'), null, [ 'class' => 'form-control ', 'data-placeholder' => 'Выберите статус']) !!}
    </div>
</div>

