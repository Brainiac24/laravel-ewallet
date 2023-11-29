<!-- code Field -->
<div class="form-group required">
    {!! Form::label('code', trans('country.backend.code').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('code', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group required">
    {!! Form::label('code_map', trans('country.backend.code_map').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('code_map', null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- name Field -->
<div class="form-group required">
    {!! Form::label('name', trans('country.backend.name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- symbol_left Field -->
<div class="form-group required">
    {!! Form::label('desc', trans('country.backend.desc').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('desc', null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- short_name Field -->
<div class="form-group required">
    {!! Form::label('iso_2', trans('country.backend.iso_2').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('iso_2', null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- iso_name Field -->
<div class="form-group required">
    {!! Form::label('iso_3', trans('country.backend.iso_3').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('iso_3', null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- is_active Field -->
<div class="form-group required">
    {!! Form::label('is_active', trans('currency.backend.is_active').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('is_active', trans('InterfaceTranses.enabled') , $country->is_active??null, ['class' => 'form-control']) !!}
    </div>
</div>