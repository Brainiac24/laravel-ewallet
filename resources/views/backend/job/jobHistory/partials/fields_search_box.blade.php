<div class="form-group">
    {!! Form::label('name', trans('jobHistory.backend.table.name'), ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('name', null, ['class'=>'form-control']) !!}
    </div>
</div>


<div class="form-group">
    {!! Form::label('status', trans('jobHistory.backend.table.status'), ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::select('status', trans('InterfaceTranses.job_history_status'), ['class'=>'form-control']) !!}
    </div>
</div>
