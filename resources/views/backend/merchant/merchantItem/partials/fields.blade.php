<div class="form-group required">
    {!! Form::label('name', trans('merchantItem.backend.name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('merchant_id', trans('merchantItem.backend.merchant_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('merchant_id', $merchantItem->merchant->name??null, ['class' => 'form-control','readonly']) !!}
    </div>
</div>

{{--{!! Form::hidden('account_id', $merchantItem->account_id, ['class' => 'form-control','readonly']) !!}--}}
{{--<div class="form-group required">--}}
    {{--{!! Form::label('account', trans('merchantItem.backend.account_id').':', ['class' => 'control-label col-sm-2']) !!}--}}
    {{--<div class='col-sm-9'>--}}
        {{--{!! Form::text('account', $merchantItem->account_without_global->number??null, ['class' => 'form-control','readonly']) !!}--}}
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

<div class="form-group required">
    {!! Form::label('is_active', trans('merchantItem.backend.is_active').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('is_active',  trans('InterfaceTranses.enabled'),  $merchantItem->is_active??null    , ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('hash', trans('merchantItem.backend.hash').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! empty($merchantItem->hash)?link_to(route('admin.merchants.items.generateHash', ['merchant_id'=>$merchantItem->merchant_id, 'id'=>$merchantItem->id]), trans('merchantItem.buttons.generatHash'), ['class' => 'btn btn-default'], $secure = null):'<p class="form-control-static">'.trans('merchantItem.alert.1').'</p>'!!}
    </div>
</div>

{{--{!! Form::hidden('account_id', $merchantItem->account_id, ['class' => 'form-control','readonly']) !!}--}}
{{--<div class="form-group required">--}}
    {{--{!! Form::label('param_account_acc', trans('merchantItem.backend.param_account_acc').':', ['class' => 'control-label col-sm-2']) !!}--}}
    {{--<div class='col-sm-9'>--}}
        {{--{!! Form::text('param_account_acc', $merchantItem->account_without_global->params_json['acc_code']??null, ['class' => 'form-control','readonly']) !!}--}}
    {{--</div>--}}
{{--</div>--}}
