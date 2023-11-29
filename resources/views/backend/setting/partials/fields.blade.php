<!-- key Field -->
<div class="form-group required">
    {!! Form::label('key', trans('setting.backend.key').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('key', null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- value Field -->
<div class="form-group required">
    {!! Form::label('value', trans('setting.backend.value').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::textarea('value', null, ['class' => 'form-control']) !!}
    </div>
</div>
