<div class="form-group required">
    {!! Form::label('merchant_name', trans('merchantUser.backend.merchant_name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('merchant_name', $merchantUser->merchant->name, ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>

<!-- user_fullname Field -->
<div class="form-group">
    {!! Form::label('user_fullname', trans('merchantUser.backend.user_fullname').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('user_fullname', $merchantUser->user->fullNameExtendedFormat, ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>

<!-- user_msisdn Field -->
<div class="form-group">
    {!! Form::label('user_msisdn', trans('merchantUser.backend.user_msisdn').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('user_msisdn', $merchantUser->user->msisdn, ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>

<!-- account_number Field -->
<div class="form-group">
    {!! Form::label('account_number', trans('merchantUser.backend.account_number').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('account_number', $merchantUser->account->number, ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>

<!-- merchant_inn Field -->
<div class="form-group">
    {!! Form::label('merchant_inn', trans('merchantUser.backend.merchant_inn').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('merchant_inn', $merchantUser->merchant->inn, ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>

<!-- merchant_address Field -->
<div class="form-group">
    {!! Form::label('merchant_address', trans('merchantUser.backend.merchant_address').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('merchant_address', $merchantUser->merchant->address, ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>

<!-- merchant_account_number Field -->
<div class="form-group">
    {!! Form::label('merchant_account_number', trans('merchantUser.backend.merchant_account_number').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('merchant_account_number', $merchantUser->merchant->account_number, ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>

<!-- merchant_city Field -->
<div class="form-group">
    {!! Form::label('merchant_city', trans('merchantUser.backend.merchant_city').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('merchant_city', $merchantUser->merchant->city->name, ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('is_active', trans('merchantUser.backend.is_active').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('is_active',  trans('InterfaceTranses.enabled'),  $merchantUser->is_active??null    , ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('is_approved', trans('merchantUser.backend.is_approved').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('is_approved',  trans('InterfaceTranses.enabled'),  $merchantUser->is_approved??null    , ['class' => 'form-control']) !!}
    </div>
</div>
