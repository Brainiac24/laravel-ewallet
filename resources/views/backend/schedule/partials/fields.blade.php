<div class="form-group required">
    {!! Form::label('name', trans('schedule.backend.name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('cron_expression', trans('schedule.backend.cron_expression').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('cron_expression', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('schedule_type_id', trans('schedule.backend.schedule_type_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select ('schedule_type_id',  $scheduleTypes , $schedule->schedule_type_id??null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('is_active', trans('schedule.backend.is_active').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select ('is_active',  trans('InterfaceTranses.enabled') , $schedule->is_active??null, ['class' => 'form-control']) !!}
    </div>
</div>