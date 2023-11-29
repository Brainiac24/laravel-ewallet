<!-- code Field -->
<div class="form-group">
    {!! Form::label('code', trans('area.backend.table.code').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $area->code }}</p>
    </div>
</div>
<!-- code Map -->
<div class="form-group">
    {!! Form::label('code_map', trans('area.backend.table.code_map').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $area->code_map }}</p>
    </div>
</div>
<div class="form-group">
    {!! Form::label('country_id', trans('country.backend.table.title').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $area->region->country->name }}</p>
    </div>
</div>

<!-- country_id Field -->
<div class="form-group">
    {!! Form::label('region_id', trans('region.backend.table.title').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $area->region->name }}</p>
    </div>
</div>
<div class="form-group">
    {!! Form::label('name', trans('area.backend.table.name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $area->name }}</p>
    </div>
</div>

<!-- name Field -->

<!-- desc -->
<div class="form-group">
    {!! Form::label('desc', trans('area.backend.table.desc').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $area->desc }}</p>
    </div>
</div>
<!-- is_active Field -->
<div class="form-group">
    {!! Form::label('is_active', trans('area.backend.table.is_active').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ trans('InterfaceTranses.enabled.'.$area->is_active) }}</p>
    </div>
</div>


<!-- created_at Field -->
<div class="form-group">
    {!! Form::label('created_at', trans('area.backend.table.created_at').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $area->created_at }}</p>
    </div>
</div>
<!-- updated_at Field -->
<div class="form-group">
    {!! Form::label('updated_at', trans('area.backend.table.updated_at').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $area->updated_at }}</p>
    </div>
</div>