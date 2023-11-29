<div class="form-group">
    {!! Form::label('username', 'Имя пользователя', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('username', null, ['class'=>'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('full_name', 'ФИО содержит', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('full_name', null, ['class'=>'form-control']) !!}
    </div>
</div>
