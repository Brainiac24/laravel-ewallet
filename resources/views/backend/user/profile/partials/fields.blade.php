<!-- Code Field -->
<div class="form-group">
    {!! Form::label('username', trans('users.backend.table.username').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('username', null, ['class' => 'form-control','readonly' => true]) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('current_password', trans('profile.backend.current_password').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::password('current_password', ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('new_password', trans('profile.backend.new_password').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::password('new_password', ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('new_password_confirmation', trans('profile.backend.new_password_confirmation').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::password('new_password_confirmation', ['class' => 'form-control']) !!}
    </div>
</div>

