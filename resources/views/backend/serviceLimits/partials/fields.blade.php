<!-- Code Field -->
<div class="form-group required">
    {!! Form::label('code', trans('serviceLimits.backend.code').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('code', null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- Name Field -->
<div class="form-group required">
    {!! Form::label('name', trans('serviceLimits.backend.name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group required">
    {!! Form::label('params_json', trans('service.backend.params_json').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <div id="jsoneditor"></div>
        {!! Form::hidden('params_json',  Route::is('admin.limits.create') ? null : json_encode($serviceLimit->params_json), ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group required">
    {!! Form::label('extend_params_json', trans('service.backend.extend_params_json').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::textarea('extend_params_json', Route::is('admin.limits.create') ? null : json_encode($serviceLimit->extend_params_json, JSON_UNESCAPED_UNICODE), ['class' => 'form-control']) !!}
    </div>
</div>
{{--<!-- day_limit Field -->--}}
{{--<div class="form-group required" >--}}
    {{--{!! Form::label('params_json[day][limit]', trans('serviceLimits.backend.day_limit').':', ['class' => 'control-label col-sm-2']) !!}--}}
    {{--<div class='col-sm-9'>--}}
        {{--{!! Form::number('params_json[day][limit]', null, ['class' => 'form-control']) !!}--}}
    {{--</div>--}}
{{--</div>--}}
{{--<!-- week_limit Field -->--}}
{{--<div class="form-group required">--}}
    {{--{!! Form::label('params_json[week][limit]', trans('serviceLimits.backend.week_limit').':', ['class' => 'control-label col-sm-2']) !!}--}}
    {{--<div class='col-sm-9'>--}}
        {{--{!! Form::number('params_json[week][limit]', null, ['class' => 'form-control']) !!}--}}
    {{--</div>--}}
{{--</div>--}}
{{--<!-- month_limit Field -->--}}
{{--<div class="form-group required">--}}
    {{--{!! Form::label('params_json[month][limit]', trans('serviceLimits.backend.month_limit').':', ['class' => 'control-label col-sm-2']) !!}--}}
    {{--<div class='col-sm-9'>--}}
        {{--{!! Form::number('params_json[month][limit]', null, ['class' => 'form-control']) !!}--}}
    {{--</div>--}}
{{--</div>--}}



