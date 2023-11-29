<!-- version Field -->
<div class="form-group">
    {!! Form::label('version', trans('coordinatePointCity.backend.version').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $coordinatePointCity->version }}</p>
    </div>
</div>
<!-- city_id Field -->
<div class="form-group">
    {!! Form::label('city_id', trans('coordinatePointCity.backend.city_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $coordinatePointCity->city->name }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('is_active', trans('coordinatePointService.backend.table.is_active').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{trans('InterfaceTranses.is_active.'. $coordinatePointCity->is_active )}}</p>
    </div>
</div>

<!-- Created_at Field -->
<div class="form-group">
    {!! Form::label('created_at', trans('coordinatePointService.backend.table.created_at').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $coordinatePointCity->created_at }}</p>
    </div>
</div>
<!-- updated_at Field -->
<div class="form-group">
    {!! Form::label('updated_at', trans('coordinatePointService.backend.table.updated_at').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $coordinatePointCity->updated_at }}</p>
    </div>
</div>