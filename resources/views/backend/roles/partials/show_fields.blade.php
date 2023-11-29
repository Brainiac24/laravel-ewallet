<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', trans('roles.backend.code').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
            <p class="form-control-static">{{ $role->name }}</p>
	</div>
</div>

<!-- Display Name Field -->
<div class="form-group">
    {!! Form::label('display_name', trans('roles.backend.display_name').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
            <p class="form-control-static">{{ $role->display_name }}</p>
	</div>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', trans('roles.backend.description').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
            <p class="form-control-static">{{ $role->description }}</p>
	</div>
</div>

<!-- Permission Field -->
<div class="form-group">
    {!! Form::label('permission', trans('roles.backend.permission').':', ['class' => 'control-label col-sm-2']) !!}
	<div class='col-sm-9'>
            <p class="form-control-static">
                @foreach($role->permissions as $permission)
                    {{ $permission->display_name }} <br/>
                @endforeach
            </p>
	</div>
</div>