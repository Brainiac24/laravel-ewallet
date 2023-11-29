<div class="form-group">
    {!! Form::label('name', trans('scheduleType.backend.name').':', ['class' => 'control-label col-sm-3']) !!}
    <div class='col-sm-8'>
        <p class="form-control-static">{{ $scheduleType->name }}</p>
    </div>
</div>
<div class="form-group">
    {!! Form::label('type', trans('scheduleType.backend.type').':', ['class' => 'control-label col-sm-3']) !!}
    <div class='col-sm-8'>
        <p class="form-control-static">{{ $scheduleType->type }}</p>
    </div>
</div>
<div class="form-group">
    {!! Form::label('value', trans('scheduleType.backend.value').':', ['class' => 'control-label col-sm-3']) !!}
    <div class='col-sm-8'>
        <p class="form-control-static">{{ $scheduleType->value }}</p>
    </div>
</div>
<div class="form-group">
    {!! Form::label('params_json', trans('scheduleType.backend.fields').':', ['class' => 'control-label col-sm-3']) !!}
    <div class='col-sm-8'>
        <p class="form-control-static">
            <span class="json-params">
                {{ json_encode($scheduleType->fields, JSON_UNESCAPED_UNICODE) }}
            </span>
        </p>
    </div>
</div>
<div class="form-group">
    {!! Form::label('is_active', trans('scheduleType.backend.is_active').':', ['class' => 'control-label col-sm-3']) !!}
    <div class='col-sm-8'>
        <p class="form-control-static">{{ trans('InterfaceTranses.enabled.'.$scheduleType->is_active) }}</p>
    </div>
</div>