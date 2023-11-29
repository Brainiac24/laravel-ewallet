<div class="form-group">
    {!! Form::label('id', 'ID', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('id', null, ['class'=>'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('table','Название таблицы в БД', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('table', null, ['class'=>'form-control']) !!}
    </div>
</div>

<div class="form-group ">
    {!! Form::label('job_log_type', trans('dwhRule.backend.table.job_log_type').':', ['class' => 'control-label col-sm-5']) !!}
    <div class='col-sm-3'>
        {!! Form::select('job_log_type',[''=>''] + config('job_log_type_helper.types'), null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('description','Описание', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('description', null, ['class'=>'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('to_dwh_days', 'Количество дней до переноса в Dwh ', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('to_dwh_days', null, ['class'=>'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('delete_from_dwh_days', 'Количество дней до удаления из Dwh', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('delete_from_dwh_days', null, ['class'=>'form-control']) !!}
    </div>
</div>


