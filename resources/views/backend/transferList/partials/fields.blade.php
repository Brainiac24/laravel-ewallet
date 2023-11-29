<!-- code Field -->
<div class="form-group required">
    {!! Form::label('code', trans('transferList.backend.code').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('code', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group required">
    {!! Form::label('code_map', trans('transferList.backend.code_map').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('code_map', null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- name Field -->
<div class="form-group required">
    {!! Form::label('name', trans('transferList.backend.name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- short_name Field -->
<div class="form-group required">
    {!! Form::label('icon_url', trans('transferList.backend.icon_url').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('icon_url', null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- iso_name Field -->
<div class="form-group required">
    {!! Form::label('desc', trans('transferList.backend.desc').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('desc', null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- is_active Field -->
<div class="form-group required">
    {!! Form::label('is_active', trans('transferList.backend.is_active').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('is_active', trans('InterfaceTranses.enabled') , $data->is_active??null, ['class' => 'form-control']) !!}
    </div>
</div>