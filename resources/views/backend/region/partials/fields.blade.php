<!-- code Field -->
<div class="form-group required">
    {!! Form::label('code', trans('region.backend.code').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('code', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group required">
    {!! Form::label('code_map', trans('region.backend.code_map').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('code_map', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group required">
    {!! Form::label('region.backend.country_id', trans('region.backend.country_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('country_id', $country , $selectedCountry??null ,['class' => 'form-control']) !!}
    </div>
</div>
<!-- name Field -->
<div class="form-group required">
    {!! Form::label('name', trans('region.backend.name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>
<!--Desc Field -->
<div class="form-group required">
    {!! Form::label('desc', trans('region.backend.desc').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('desc', null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- is_active Field -->
<div class="form-group required">
    {!! Form::label('is_active', trans('region.backend.is_active').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('is_active', trans('InterfaceTranses.enabled') , $region->is_active??null, ['class' => 'form-control']) !!}
    </div>
</div>

