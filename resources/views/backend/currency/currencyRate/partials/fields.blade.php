<!-- value_buy Field -->
<div class="form-group required">
    {!! Form::label('value_buy', trans('currencyRate.backend.value_buy').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('value_buy', null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- value_sell Field -->
<div class="form-group required">
    {!! Form::label('value_sell', trans('currencyRate.backend.value_sell').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('value_sell', null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- currency_id Field -->
<div class="form-group required">
    {!! Form::label('currency_id', trans('currencyRate.backend.currency_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('currency_id', $currencies, Route::is('admin.users.services.limits.create') ? null : $selectedCurrencyRate, ['name' => 'currency_id', 'id' => 'currency_id', 'class' => 'form-control select2 ', 'data-placeholder' => 'Выберите Валюту']) !!}
    </div>
</div>
<!-- currency_rate_category_id Field -->
<div class="form-group required">
    {!! Form::label('currency_rate_category_id', trans('currencyRate.backend.currency_rate_category_name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('currency_rate_category_id', $currency_rate_categories, Route::is('admin.users.services.limits.create') ? null : $selectedCurrencyRateCategory, ['name' => 'currency_rate_category_id', 'id' => 'currency_rate_category_id', 'class' => 'form-control select2 ', 'data-placeholder' => 'Выберите Категорию']) !!}
    </div>
</div>
