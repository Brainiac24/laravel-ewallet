<!-- code Field -->
<div class="form-group required">
    {!! Form::label('table', trans('dwhRule.backend.table.table').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('table', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group ">
    {!! Form::label('job_log_type', trans('dwhRule.backend.table.job_log_type').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('job_log_type',[''=>''] + config('job_log_type_helper.types'), null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group ">
    {!! Form::label('description', trans('dwhRule.backend.table.description').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('description', null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- name Field -->
<div class="form-group ">
    {!! Form::label('to_dwh_days', trans('dwhRule.backend.table.to_dwh_days').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::number('to_dwh_days', null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- symbol_left Field -->
<div class="form-group ">
    {!! Form::label('delete_from_dwh_days', trans('dwhRule.backend.table.delete_from_dwh_days').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::number('delete_from_dwh_days', null, ['class' => 'form-control']) !!}
    </div>
</div>

