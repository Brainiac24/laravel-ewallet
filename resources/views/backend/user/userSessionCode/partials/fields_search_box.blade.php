<div class="form-group">
    {!! Form::label('id', 'ID', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('id', null, ['class'=>'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('value', trans('userSessionCode.backend.table.value'), ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('value', null, ['class'=>'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('user_session_code_type_id', trans('userSessionCode.backend.table.user_session_code_type_id'), ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::select('user_session_code_type_id', [''=>'']+ $filterUserSessionCodeTypes, ['class'=>'form-control']) !!}
    </div>
</div>


