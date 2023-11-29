<!-- Name Field -->
<div class="form-group required">
    {!! Form::label('name', trans('service.backend.name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- monday Field -->
<div class="form-group required">
    {!! Form::label('code', trans('service.backend.code').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('code', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group required">
    {!! Form::label('code_map', trans('service.backend.code_map').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('code_map', null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- tuesday Field -->
<div class="form-group required">
    {!! Form::label('processing_code', trans('service.backend.processing_code').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('processing_code', null, ['class' => 'form-control']) !!}
    </div>
</div>










<div class="form-group">
    {!! Form::label('icon_url_text', trans('service.backend.icon_url'), ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('icon_url_text' , $service->icon_url??null, ['class' => 'form-control','readonly' => 'true']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('icon_url_lb', trans('news.backend.image').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        @if(($service->icon_url??null) != null)
            <div class='col-sm-12'><img src="{!! url('/imgs/services/1/'.$service->icon_url) !!}" alt="{{ $service->icon_url }}"></div>
            {!! Form::submit(trans('actions.general.delete'), ['class' => 'btn btn-danger btn-margin-top-10','form'=>'form-delete-image-icon-url']) !!}
        @else
            {!! Form::label('img_logo_is_null', 'Картинка не установлена', ['class' => 'control-label col-sm-0']) !!}
        @endif
    </div>
</div>

<div class="form-group">
    {!! Form::label('icon_url', ' ', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::file('icon_url', ['class' => 'form-control', "accept"=>"image/*"]) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('in_icon_url_text', trans('service.backend.in_icon_url'), ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('in_icon_url_text' , $service->in_icon_url??null, ['class' => 'form-control','readonly' => 'true']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('in_icon_url_lb', trans('news.backend.image').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        @if(($service->in_icon_url??null) != null)
            <div class='col-sm-12'><img src="{!! url('/imgs/services/1/'.$service->in_icon_url) !!}" alt="{{ $service->in_icon_url }}"></div>
            {!! Form::submit(trans('actions.general.delete'), ['class' => 'btn btn-danger btn-margin-top-10','form'=>'form-delete-image-in-icon-url']) !!}
        @else
            {!! Form::label('in_icon_url_is_null', 'Картинка не установлена', ['class' => 'control-label col-sm-0']) !!}
        @endif
    </div>
</div>

<div class="form-group">
    {!! Form::label('in_icon_url', ' ', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::file('in_icon_url', ['class' => 'form-control', "accept"=>"image/*"]) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('out_icon_url_text', trans('service.backend.out_icon_url'), ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('out_icon_url_text' , $service->out_icon_url??null, ['class' => 'form-control','readonly' => 'true']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('out_icon_url_lb', trans('service.backend.out_icon_url').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        @if(($service->out_icon_url??null) != null)
            <div class='col-sm-12'><img src="{!! url('/imgs/services/1/'.$service->out_icon_url) !!}" alt="{{ $service->out_icon_url }}"></div>
            {!! Form::submit(trans('actions.general.delete'), ['class' => 'btn btn-danger btn-margin-top-10','form'=>'form-delete-image-out-icon-url']) !!}
        @else
            {!! Form::label('out_icon_url_is_null', 'Картинка не установлено', ['class' => 'control-label col-sm-0']) !!}
        @endif
    </div>
</div>

<div class="form-group">
    {!! Form::label('out_icon_url', ' ', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::file('out_icon_url', ['class' => 'form-control', "accept"=>"image/*"]) !!}
    </div>
</div>





















<!-- friday Field -->
<div class="form-group required">
    {!! Form::label('min_amount', trans('service.backend.min_amount').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('min_amount', null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- saturday Field -->
<div class="form-group required">
    {!! Form::label('max_amount', trans('service.backend.max_amount').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('max_amount', null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- sunday Field -->
<div class="form-group required">
    {!! Form::label('is_active', trans('service.backend.is_active').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select ('is_active',  trans('InterfaceTranses.enabled') , $service->is_active??null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- sunday Field -->
<div class="form-group required">
    {!! Form::label('is_enabled', trans('service.backend.is_enabled').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select ('is_enabled',  trans('InterfaceTranses.enabled') , $service->is_enabled??null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('position', trans('service.backend.position').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('position', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('gateway_id', trans('service.backend.gateway_name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('gateway_id', $gateways, Route::is('admin.services.create') ? null : $service->gateway->id??null, ['name' => 'gateway_id',
        'id' => 'gateway_id', 'class' => 'form-control', 'data-placeholder' => 'Выберите '. mb_strtolower (trans('service.backend.gateway_name'))])
        !!}
    </div>
</div>
<div class="form-group required">
    {!! Form::label('currency_id', trans('service.backend.currency_iso_name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('currency_id', $currencies, Route::is('admin.services.create') ? null : $service->currency->id, ['name'
        => 'currency_id', 'id' => 'currency_id', 'class' => 'form-control', 'data-placeholder' => 'Выберите '. mb_strtolower
        (trans('service.backend.currency_iso_name'))]) !!}
    </div>
</div>

<!-- currency_rate_category_id Field -->
<div class="form-group required">
    {!! Form::label('currency_rates_category_id', trans('service.backend.currency_rate_category_name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('currency_rates_category_id', $currency_rate_categories, Route::is('admin.users.services.limits.create') ? null : $service->currency_rate_category->id??null, ['name' => 'currency_rate_category_id', 'id' => 'currency_rate_category_id', 'class' => 'form-control select2 ', 'data-placeholder' => 'Выберите Категорию']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('service_limit_id', trans('service.backend.service_limit_name').':', ['class' => 'control-label col-sm-2'])
    !!}
    <div class='col-sm-9'>
        {!! Form::select('service_limit_id', $serviceLimits, Route::is('admin.services.create') ? null : $service->service_limit->id??null,
        ['name' => 'service_limit_id', 'id' => 'service_limit_id', 'class' => 'form-control ', 'data-placeholder'
        => 'Выберите '. mb_strtolower (trans('service.backend.service_limit_name'))]) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('service_otp_limit_id', trans('service.backend.service_otp_limit_name').':', ['class' => 'control-label col-sm-2'])
    !!}
    <div class='col-sm-9'>
        {!! Form::select('service_otp_limit_id', $serviceOtpLimits, Route::is('admin.services.create') ? null : $service->service_otp_limit->id??null,
        ['name' => 'service_otp_limit_id', 'id' => 'service_otp_limit_id', 'class' => 'form-control ', 'data-placeholder'
        => 'Выберите '. mb_strtolower (trans('service.backend.service_otp_limit_name'))]) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('is_to_accountable', trans('service.backend.is_to_accountable').':', ['class' => 'control-label col-sm-2'])
    !!}
    <div class='col-sm-9'>
        {!! Form::select ('is_to_accountable', trans('InterfaceTranses.enabled') , $service->is_to_accountable??null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('commission_id', trans('service.backend.commission_name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('commission_id', $commissions, Route::is('admin.services.create') ? null : $service->commission->id??null, ['name'
        => 'commission_id', 'id' => 'commission_id', 'class' => 'form-control', 'data-placeholder' => 'Выберите
        '. mb_strtolower (trans('service.backend.commission_name'))]) !!}
    </div>
</div>
<div class="form-group ">
    {!! Form::label('workday_id', trans('service.backend.workday_name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('workday_id', $workdays, Route::is('admin.services.create') ? null : $service->workday->id??null, ['name' => 'workday_id',
        'id' => 'workday_id', 'class' => 'form-control', 'data-placeholder' => 'Выберите '. mb_strtolower (trans('service.backend.workday_name'))])
        !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('requestable_balance_params', trans('service.backend.requestable_balance_params').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('requestable_balance_params', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('is_checkable', trans('service.backend.is_checkable').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('is_checkable', trans('InterfaceTranses.yesno'),null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('extend_params_json', trans('service.backend.extend_params_json').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::textarea('extend_params_json', Route::is('admin.services.create') ? null : json_encode($service->extend_params_json, JSON_UNESCAPED_UNICODE), ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('add_to_favorite', trans('service.backend.add_to_favorite').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::hidden('add_to_favorite', 0) !!}
        {!! Form::checkbox('add_to_favorite') !!}
    </div>
</div>
<div class="form-group required">
    {!! Form::label('params_json', trans('service.backend.params_json').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <div id="jsoneditor"></div>
        {!! Form::hidden('params_json',  Route::is('admin.services.create') ? null : json_encode($service->params_json), ['class' => 'form-control']) !!}
    </div>
</div>