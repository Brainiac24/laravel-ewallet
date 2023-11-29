<!-- key Field -->
<div class="form-group required">
    {!! Form::label('key', trans('setting.backend.key').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::label('key', null, ['class' => 'control-label col-sm-2']) !!}
    </div>
</div>
<!-- value Field -->
<div class="form-group required">
    {!! Form::label('value', trans('setting.backend.value').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
    <div class="{{ !is_array(json_decode($setting->value)) ?: 'json-params' }}">{{ json_encode(json_decode($setting->value, JSON_UNESCAPED_UNICODE)) }}</div>
    </div>
</div>
