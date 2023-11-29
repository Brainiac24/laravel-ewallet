<div class="form-group required">
    {!! Form::label('name', trans('merchantCommissionItem.backend.name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('min', trans('merchantCommissionItem.backend.min').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('min', $maxValue, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('max', trans('merchantCommissionItem.backend.max').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('max', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('value', trans('merchantCommissionItem.backend.value').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('value', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('is_percentage', trans('merchantCommissionItem.backend.is_percentage').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('is_percentage',  trans('InterfaceTranses.yesno'), 1, ['class' => 'form-control']) !!}
    </div>
</div>

{{--<div class="form-group required">--}}
    {{--{!! Form::label('merchant_commission_id', trans('merchantCommissionItem.backend.merchant_commission_id').':', ['class' => 'control-label col-sm-2']) !!}--}}
    {{--<div class='col-sm-9'>--}}
        {{--{!! Form::select('merchant_commission_id', $filterMerchantCommissions, $data->merchant_commission_id??null, ['class' => 'form-control']) !!}--}}
    {{--</div>--}}
{{--</div>--}}

<div class="form-group required">
    {!! Form::label('merchant_commission_id', trans('merchantCommissionItem.backend.merchant_commission_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('merchant_commission_id', $merchant_commission_name ?? null, ['class' => 'form-control','readonly']) !!}
    </div>
</div>

{{--<div class="form-group required">--}}
    {{--{!! Form::label('is_active', trans('merchantCommissionItem.backend.is_active').':', ['class' => 'control-label col-sm-2']) !!}--}}
    {{--<div class='col-sm-9'>--}}
        {{--{!! Form::select('is_active',  trans('InterfaceTranses.enabled'), 1, ['class' => 'form-control']) !!}--}}
    {{--</div>--}}
{{--</div>--}}