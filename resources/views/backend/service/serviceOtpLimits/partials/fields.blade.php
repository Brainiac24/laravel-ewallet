<!-- Code Field -->
<div class="form-group required">
    {!! Form::label('code', trans('serviceOtpLimits.backend.code').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('code', null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- Name Field -->
<div class="form-group required">
    {!! Form::label('name', trans('serviceOtpLimits.backend.name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group required">
    {!! Form::label('params_json', trans('serviceOtpLimits.backend.params_json').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <div id="jsoneditor"></div>
        {!! Form::hidden('params_json',  Route::is('admin.serviceOtpLimits.create') ? null : json_encode($serviceOtpLimits->params_json), ['class' => 'form-control']) !!}
    </div>
</div>