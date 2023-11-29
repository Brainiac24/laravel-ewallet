<!-- merchant_name Field -->
<div class="form-group">
    {!! Form::label('merchant_name', trans('merchantUser.backend.merchant_name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $merchantUser->merchant->name }}</p>
    </div>
</div>

<!-- user_fullname Field -->
<div class="form-group">
    {!! Form::label('user_fullname', trans('merchantUser.backend.user_fullname').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $merchantUser->user->fullNameExtendedFormat }}</p>
    </div>
</div>

<!-- user_msisdn Field -->
<div class="form-group">
    {!! Form::label('user_msisdn', trans('merchantUser.backend.user_msisdn').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $merchantUser->user->msisdn }}</p>
    </div>
</div>

<!-- account_number Field -->
<div class="form-group">
    {!! Form::label('account_number', trans('merchantUser.backend.account_number').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $merchantUser->account->number }}</p>
    </div>
</div>

<!-- merchant_inn Field -->
<div class="form-group">
    {!! Form::label('merchant_inn', trans('merchantUser.backend.merchant_inn').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $merchantUser->merchant->inn }}</p>
    </div>
</div>

<!-- merchant_address Field -->
<div class="form-group">
    {!! Form::label('merchant_address', trans('merchantUser.backend.merchant_address').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $merchantUser->merchant->address }}</p>
    </div>
</div>

<!-- merchant_account_number Field -->
<div class="form-group">
    {!! Form::label('merchant_account_number', trans('merchantUser.backend.merchant_account_number').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $merchantUser->merchant->account_number }}</p>
    </div>
</div>

<!-- merchant_city Field -->
<div class="form-group">
    {!! Form::label('merchant_city', trans('merchantUser.backend.merchant_city').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $merchantUser->merchant->city->name }}</p>
    </div>
</div>

<!-- is_approved Field -->
<div class="form-group">
    {!! Form::label('is_approved', trans('merchantUser.backend.is_approved').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ trans('InterfaceTranses.enabled.'.$merchantUser->is_approved) }}</p>
    </div>
</div>

<!-- is_active Field -->
<div class="form-group">
    {!! Form::label('is_active', trans('merchantUser.backend.is_active').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ trans('InterfaceTranses.enabled.'.$merchantUser->is_active) }}</p>
    </div>
</div>

<!-- created_at Field -->
<div class="form-group">
    {!! Form::label('created_at', trans('merchantUser.backend.created_at').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $merchantUser->created_at }}</p>
    </div>
</div>

<!-- updated_at Field -->
<div class="form-group">
    {!! Form::label('updated_at', trans('merchantUser.backend.updated_at').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $merchantUser->updated_at }}</p>
    </div>
</div>