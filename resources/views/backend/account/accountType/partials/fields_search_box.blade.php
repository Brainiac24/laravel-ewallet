<div class="form-group">
    {!! Form::label('name', trans('accountType.backend.table.name'), ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('name', null, ['class'=>'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('code_map', trans('accountType.backend.table.code_map'), ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('code_map', null, ['class'=>'form-control']) !!}
    </div>
</div>
