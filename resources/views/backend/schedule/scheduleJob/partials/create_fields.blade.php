<div class="form-group required">
    {!! Form::label('schedule_type_id', trans('schedule.backend.schedule_type_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select ('schedule_type_id',  $scheduleTypes, null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('from_date', 'Дата запуска:', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-9">
        <input type="datetime-local" name="from_date" value="{{\Carbon\Carbon::now()}}">
    </div>
</div>

<div id="generate-form">

</div>