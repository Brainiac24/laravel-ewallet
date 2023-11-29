<!-- Code Field -->
<div class="form-group required">
    {!! Form::label('code', trans('roles.backend.code').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('code', null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- Name Field -->
<div class="form-group required">
    {!! Form::label('name', trans('roles.backend.display_name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- day_limit Field -->
<div class="form-group required" >
    {!! Form::label('day_limit', trans('attestations.backend.day_limit').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::number('params_json[day][limit]', null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- week_limit Field -->
<div class="form-group required">
    {!! Form::label('week_limit', trans('attestations.backend.week_limit').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::number('params_json[week][limit]', null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- month_limit Field -->
<div class="form-group required">
    {!! Form::label('month_limit', trans('attestations.backend.month_limit').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::number('params_json[month][limit]', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Balance Field -->
<div class="form-group required">
    {!! Form::label('balance', trans('attestations.backend.balance').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::number('params_json[balance][limit]', null, ['class' => 'form-control']) !!}
    </div>
</div>


