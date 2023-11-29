<div class="form-group">
    {!! Form::label('name', trans('service.backend.name').':', ['class' => 'control-label col-sm-3']) !!}
    <div class='col-sm-8'>
        <p class="form-control-static">{{ $service->name }}</p>
    </div>
</div>
<div class="form-group">
    {!! Form::label('code', trans('service.backend.code').':', ['class' => 'control-label col-sm-3']) !!}
    <div class='col-sm-8'>
        <p class="form-control-static">{{ $service->code }}</p>
    </div>
</div>
<div class="form-group">
    {!! Form::label('code_map', trans('service.backend.code_map').':', ['class' => 'control-label col-sm-3']) !!}
    <div class='col-sm-8'>
        <p class="form-control-static">{{ $service->code_map }}</p>
    </div>
</div>
<div class="form-group">
    {!! Form::label('processing_code', trans('service.backend.processing_code').':', ['class' => 'control-label col-sm-3']) !!}
    <div class='col-sm-8'>
        <p class="form-control-static">{{ $service->processing_code }}</p>
    </div>
</div>
<div class="form-group">
    {!! Form::label('icon_url', trans('service.backend.icon_url').':', ['class' => 'control-label col-sm-3']) !!}
    <div class='col-sm-8'>
        <p class="form-control-static"><img src="{{ '../../'. config('app_settings.service_icons_url_host').'/hdpi/'.$service->icon_url }}" alt="{{$service->icon_url}}"></p>
    </div>
</div>
<div class="form-group">
    {!! Form::label('in_icon_url', trans('service.backend.in_icon_url').':', ['class' => 'control-label col-sm-3']) !!}
    <div class='col-sm-8'>
        <p class="form-control-static"><img src="{{ '../../'. config('app_settings.service_icons_url_host').'/hdpi/'.$service->in_icon_url }}" alt="{{$service->in_icon_url}}"></p>
    </div>
</div>
<div class="form-group">
    {!! Form::label('out_icon_url', trans('service.backend.out_icon_url').':', ['class' => 'control-label col-sm-3']) !!}
    <div class='col-sm-8'>
        <p class="form-control-static"><img src="{{ '../../'. config('app_settings.service_icons_url_host').'/hdpi/'.$service->out_icon_url }}" alt="{{ $service->out_icon_url }}"></p>
    </div>
</div>
<div class="form-group">
    {!! Form::label('params_json', trans('service.backend.params_json').':', ['class' => 'control-label col-sm-3']) !!}
    <div class='col-sm-8'>
        <p class="form-control-static">
            <span class="json-params">
                {{ json_encode($service->params_json, JSON_UNESCAPED_UNICODE) }}
            </span>
        </p>
    </div>
</div>
<div class="form-group">
    {!! Form::label('min_amount', trans('service.backend.min_amount').':', ['class' => 'control-label col-sm-3']) !!}
    <div class='col-sm-8'>
        <p class="form-control-static">{{ $service->min_amount }}</p>
    </div>
</div>
<div class="form-group">
    {!! Form::label('max_amount', trans('service.backend.max_amount').':', ['class' => 'control-label col-sm-3']) !!}
    <div class='col-sm-8'>
        <p class="form-control-static">{{ $service->max_amount }}</p>
    </div>
</div>
<div class="form-group">
    {!! Form::label('is_checkable', trans('service.backend.is_checkable').':', ['class' => 'control-label col-sm-3']) !!}
    <div class='col-sm-8'>
        <p class="form-control-static">{{ trans('InterfaceTranses.yesno.'.$service->is_checkable) }}</p>
    </div>
</div>
<div class="form-group">
    {!! Form::label('is_active', trans('service.backend.is_active').':', ['class' => 'control-label col-sm-3']) !!}
    <div class='col-sm-8'>
        <p class="form-control-static">{{ trans('InterfaceTranses.enabled.'.$service->is_active) }}</p>
    </div>
</div>
<div class="form-group">
    {!! Form::label('is_enabled', trans('service.backend.is_enabled').':', ['class' => 'control-label col-sm-3']) !!}
    <div class='col-sm-8'>
        <p class="form-control-static">{{ trans('InterfaceTranses.enabled.'.$service->is_enabled) }}</p>
    </div>
</div>
<div class="form-group">
    <div class="row">
        {!! Form::label('requestable_balance_params', trans('service.backend.requestable_balance_params').':', ['class' => 'control-label
        col-sm-3']) !!}
        <div class='col-sm-8'>
            <p class="form-control-static">{{ $service->requestable_balance_params }}</p>
        </div>
    </div>
</div>
<div class="form-group">
    {!! Form::label('params_json', trans('service.backend.extend_params_json').':', ['class' => 'control-label col-sm-3']) !!}
    <div class='col-sm-8'>
        <p class="form-control-static">
            <span class="json-params">
                {{ json_encode($service->extend_params_json, JSON_UNESCAPED_UNICODE) }}
            </span>
        </p>
    </div>
</div>
<div class="form-group">
    {!! Form::label('is_to_accountable', trans('service.backend.is_to_accountable').':', ['class' => 'control-label col-sm-3'])
    !!}
    <div class='col-sm-8'>
        <p class="form-control-static">{{ trans('InterfaceTranses.enabled.'.$service->is_to_accountable) }}</p>
    </div>
</div>
<div class="form-group">
    {!! Form::label('position', trans('service.backend.position').':', ['class' => 'control-label col-sm-3']) !!}
    <div class='col-sm-8'>
        <p class="form-control-static">{{ $service->position }}</p>
    </div>
</div>
<div class="form-group">
    {!! Form::label('service_limit_name', trans('service.backend.service_limit_name').':', ['class' => 'control-label col-sm-3'])
    !!}
    <div class='col-sm-8'>
        <p class="form-control-static">{{ $service->service_limit->name??null }}</p>
    </div>
</div>
<div class="form-group">
    {!! Form::label('service_limit_name', trans('service.backend.service_otp_limit_name').':', ['class' => 'control-label col-sm-3'])
    !!}
    <div class='col-sm-8'>
        <p class="form-control-static"><a href="serviceOtpLimits/{{$service->service_otp_limit->id??null}}">{{ $service->service_otp_limit->name??null }}</a></p>
    </div>
</div>
<div class="form-group">
    {!! Form::label('gateway_name', trans('service.backend.gateway_name').':', ['class' => 'control-label col-sm-3']) !!}
    <div class='col-sm-8'>
        <p class="form-control-static">{{ $service->gateway->name }}</p>
    </div>
</div>
<div class="form-group">
    {!! Form::label('workday_name', trans('service.backend.workday_name').':', ['class' => 'control-label col-sm-3']) !!}
    <div class='col-sm-8'>
        <p class="form-control-static">{{ $service->workday->name??null }}</p>
    </div>
</div>
<div class="form-group">
    {!! Form::label('commission_name', trans('service.backend.commission_name').':', ['class' => 'control-label col-sm-3']) !!}
    <div class='col-sm-8'>
        <p class="form-control-static">{{ $service->commission->name??null }}</p>
    </div>
</div>
<div class="form-group">
    {!! Form::label('currency_iso_name', trans('service.backend.currency_iso_name').':', ['class' => 'control-label col-sm-3'])
    !!}
    <div class='col-sm-8'>
        <p class="form-control-static">{{ $service->currency->iso_name }}</p>
    </div>
</div>