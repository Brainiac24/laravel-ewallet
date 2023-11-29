<!-- code Field -->
<div class="form-group required">
    {!! Form::label('code', trans('gateways.backend.code').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('code', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- name Field -->
<div class="form-group required">
    {!! Form::label('name', trans('gateways.backend.name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- params_json Field -->
<div class="form-group required">
    {!! Form::label('params_json', trans('gateways.backend.params_json').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::textarea('params_json', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- is_active Field -->
<div class="form-group required">
    {!! Form::label('is_active', trans('gateways.backend.is_active').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('is_active',  trans('InterfaceTranses.enabled'),  $gateway->is_active??null    , ['class' => 'form-control']) !!}
    </div>
</div>

<!-- is_enabled_for_account Field -->
<div class="form-group required">
    {!! Form::label('is_enabled_for_account', trans('gateways.backend.is_enabled_for_account').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('is_enabled_for_account', trans('InterfaceTranses.enabled'), $gateway->is_enabled_for_account??null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- is_enabled_for_service Field -->
<div class="form-group required">
    {!! Form::label('is_enabled_for_service', trans('gateways.backend.is_enabled_for_service').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('is_enabled_for_service', trans('InterfaceTranses.enabled'), $gateway->is_enabled_for_account??null, ['class' => 'form-control']) !!}
    </div>
</div>