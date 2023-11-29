<div class="form-group">
    {!! Form::label('code', trans('city.backend.table.code').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $city->code }}</p>
    </div>
</div>
<!-- code Map -->
<div class="form-group">
    {!! Form::label('code_map', trans('city.backend.table.code_map').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $city->code_map }}</p>
    </div>
</div>
<!-- code Field -->
<div class="form-group">
    {!! Form::label('country_id', trans('country.backend.table.title').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $city->area->region->country->name }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('region_id', trans('region.backend.table.title').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $city->area->region->name }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('area_id', trans('area.backend.table.title').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $city->area->name }}</p>
    </div>
</div>
<div class="form-group">
    {!! Form::label('name', trans('city.backend.table.name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $city->name }}</p>
    </div>
</div>

<!-- name Field -->

<!-- desc -->
<div class="form-group">
    {!! Form::label('desc', trans('city.backend.table.desc').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $city->desc }}</p>
    </div>
</div>
<!-- is_active Field -->
<div class="form-group">
    {!! Form::label('is_active', trans('city.backend.table.is_active').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ trans('InterfaceTranses.enabled.'.$city->is_active) }}</p>
    </div>
</div>
<!-- country_id Field -->




<!-- created_at Field -->
<div class="form-group">
    {!! Form::label('created_at', trans('city.backend.table.created_at').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $city->created_at }}</p>
    </div>
</div>
<!-- updated_at Field -->
<div class="form-group">
    {!! Form::label('updated_at', trans('city.backend.table.updated_at').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $city->updated_at }}</p>
    </div>
</div>