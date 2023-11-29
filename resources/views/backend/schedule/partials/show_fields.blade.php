<div class="form-group">
    {!! Form::label('name', trans('schedule.backend.name').':', ['class' => 'control-label col-sm-3']) !!}
    <div class='col-sm-8'>
        <p class="form-control-static">{{ $schedule->name }}</p>
    </div>
</div>
<div class="form-group">
    {!! Form::label('cron_expression', trans('schedule.backend.cron_expression').':', ['class' => 'control-label col-sm-3']) !!}
    <div class='col-sm-8'>
        <p class="form-control-static">{{ $schedule->cron_expression }}</p>
    </div>
</div>
<div class="form-group">
    {!! Form::label('create_by_user_id', trans('schedule.backend.create_by_user_id').':', ['class' => 'control-label col-sm-3']) !!}
    <div class='col-sm-8'>
        <p class="form-control-static">{{ $schedule->createByUser->fullNameExtendedFormat }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('schedule_type_id', trans('schedule.backend.schedule_type_id').':', ['class' => 'control-label col-sm-3']) !!}
    <div class='col-sm-8'>
        <p class="form-control-static">{{ $schedule->scheduleType->name }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('is_active', trans('schedule.backend.is_active').':', ['class' => 'control-label col-sm-3']) !!}
    <div class='col-sm-8'>
        <p class="form-control-static">{{ trans('InterfaceTranses.enabled.'.$schedule->is_active) }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('created_at', trans('schedule.backend.table.created_at').':', ['class' => 'control-label col-sm-3']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $schedule->created_at }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('updated_at', trans('schedule.backend.table.updated_at').':', ['class' => 'control-label col-sm-3']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $schedule->updated_at }}</p>
    </div>
</div>