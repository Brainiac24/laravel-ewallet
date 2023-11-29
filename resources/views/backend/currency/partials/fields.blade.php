<!-- code Field -->
<div class="form-group required">
    {!! Form::label('code', trans('currency.backend.code').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('code', null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- name Field -->
<div class="form-group required">
    {!! Form::label('name', trans('currency.backend.name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- short_name Field -->
<div class="form-group required">
    {!! Form::label('short_name', trans('currency.backend.short_name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('short_name', null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- iso_name Field -->
<div class="form-group required">
    {!! Form::label('iso_name', trans('currency.backend.iso_name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('iso_name', null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- symbol_left Field -->
<div class="form-group required">
    {!! Form::label('symbol_left', trans('currency.backend.symbol_left').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('symbol_left', null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- symbol_right Field -->
<div class="form-group required">
    {!! Form::label('symbol_right', trans('currency.backend.symbol_right').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('symbol_right', null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- is_primary Field -->
<div class="form-group required">
    {!! Form::label('is_primary', trans('currency.backend.is_primary').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('is_primary', trans('InterfaceTranses.yesno'),$currency->is_primary??null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- is_active Field -->
<div class="form-group required">
    {!! Form::label('is_active', trans('currency.backend.is_active').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('is_active', trans('InterfaceTranses.enabled') , $currency->is_active??null, ['class' => 'form-control']) !!}
    </div>
</div>