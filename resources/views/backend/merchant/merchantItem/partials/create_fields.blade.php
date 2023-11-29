<div class="form-group required">
    {!! Form::label('name', trans('merchantItem.backend.name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>

{{--<div class="form-group required">--}}
    {{--{!! Form::label('merchant_id', trans('merchantItem.backend.merchant_id').':', ['class' => 'control-label col-sm-2']) !!}--}}
    {{--<div class='col-sm-9'>--}}
        {{--{!! Form::select('merchant_id', $filterMerchants, $merchantItem->merchant_id??null, ['class' => 'form-control']) !!}--}}
    {{--</div>--}}
{{--</div>--}}

<div class="form-group required">
    {!! Form::label('merchant_id', trans('merchantItem.backend.merchant_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('merchant_id', $merchant_name ?? null, ['class' => 'form-control','readonly']) !!}
    </div>
</div>

{{--<div class="form-group required">--}}
    {{--{!! Form::label('account_number', trans('merchantItem.backend.account_number').':', ['class' => 'control-label col-sm-2']) !!}--}}
    {{--<div class='col-sm-9'>--}}
        {{--{!! Form::text('account_number', null, ['class' => 'form-control']) !!}--}}
    {{--</div>--}}
{{--</div>--}}

<div class="form-group required">
    {!! Form::label('phone', trans('merchantItem.backend.phone').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('phone', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('email', trans('merchantItem.backend.email').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('email', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('address', trans('merchantItem.backend.address').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('address', null, ['class' => 'form-control']) !!}
    </div>
</div>

{{--<div class="form-group required">--}}
    {{--{!! Form::label('account_id', trans('merchantItems.backend.account_id').':', ['class' => 'control-label col-sm-2']) !!}--}}
    {{--<div class='col-sm-9'>--}}
        {{--{!! Form::select('account_id', $merchantItems, $merchantItem->account_id??null, ['class' => 'form-control']) !!}--}}
    {{--</div>--}}
{{--</div>--}}

<div class="form-group required">
    {!! Form::label('is_active', trans('merchantItem.backend.is_active').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('is_active',  trans('InterfaceTranses.enabled'), 1, ['class' => 'form-control']) !!}
    </div>
</div>

