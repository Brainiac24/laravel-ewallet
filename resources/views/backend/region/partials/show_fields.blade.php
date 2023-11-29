<!-- code Field -->
<div class="form-group">
    {!! Form::label('code', trans('region.backend.table.code').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $region->code }}</p>
    </div>
</div>
<!-- code Map -->
<div class="form-group">
    {!! Form::label('code_map', trans('region.backend.table.code_map').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $region->code_map }}</p>
    </div>
</div>
<!-- country_id Field -->
<div class="form-group">
    {!! Form::label('country_id', trans('region.backend.table.country_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $region->country->name }}</p>
    </div>
</div>
<!-- name Field -->
<div class="form-group">
    {!! Form::label('name', trans('region.backend.table.name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $region->name }}</p>
    </div>
</div>
<!-- desc -->
<div class="form-group">
    {!! Form::label('desc', trans('region.backend.table.desc').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $region->desc }}</p>
    </div>
</div>
<!-- is_active Field -->
<div class="form-group">
    {!! Form::label('is_active', trans('region.backend.table.is_active').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ trans('InterfaceTranses.enabled.'.$region->is_active) }}</p>
    </div>
</div>
<!-- created_at Field -->
<div class="form-group">
    {!! Form::label('created_at', trans('region.backend.table.created_at').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $region->created_at }}</p>
    </div>
</div>
<!-- updated_at Field -->
<div class="form-group">
    {!! Form::label('updated_at', trans('country.backend.table.updated_at').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $region->updated_at }}</p>
    </div>
</div>