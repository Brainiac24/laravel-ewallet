<!-- code Field -->
<div class="form-group">
    {!! Form::label('code', trans('country.backend.table.code').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $country->code }}</p>
    </div>
</div>
<!-- code Map -->
<div class="form-group">
    {!! Form::label('code_map', trans('country.backend.table.code_map').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $country->code_map }}</p>
    </div>
</div>
<!-- name Field -->
<div class="form-group">
    {!! Form::label('name', trans('country.backend.table.name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $country->name }}</p>
    </div>
</div>
<!-- desc -->
<div class="form-group">
    {!! Form::label('desc', trans('country.backend.table.desc').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $country->desc }}</p>
    </div>
</div>
<!-- iso_2 Field -->
<div class="form-group">
    {!! Form::label('iso_2', trans('country.backend.table.iso_2').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $country->iso_2}}</p>
    </div>
</div>
<!-- iso_3 Field -->
<div class="form-group">
    {!! Form::label('iso_3', trans('country.backend.table.iso_3').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $country->iso_3}}</p>
    </div>
</div>
<!-- is_active Field -->
<div class="form-group">
    {!! Form::label('is_active', trans('country.backend.table.is_active').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ trans('InterfaceTranses.enabled.'.$country->is_active) }}</p>
    </div>
</div>
<!-- created_at Field -->
<div class="form-group">
    {!! Form::label('created_at', trans('country.backend.table.created_at').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $country->created_at }}</p>
    </div>
</div>
<!-- updated_at Field -->
<div class="form-group">
    {!! Form::label('updated_at', trans('country.backend.table.updated_at').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $country->updated_at }}</p>
    </div>
</div>