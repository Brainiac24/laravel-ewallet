<!-- Name Field -->
<div class="form-group required">
    {!! Form::label('name', trans('coordinatePointService.backend.name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- position Field -->
<div class="form-group required">
    {!! Form::label('position', trans('coordinatePointService.backend.position').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::number('position', null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- is_show_for_filter Field -->
<div class="form-group required">
    {!! Form::label('is_show_for_filter', trans('coordinatePointService.backend.is_show_for_filter').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('is_show_for_filter', trans('InterfaceTranses.verified'),$coordinatePointService->is_show_for_filter??null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- is_active Field -->
<div class="form-group required">
    {!! Form::label('is_active', trans('coordinatePointService.backend.is_active').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('is_active', trans('InterfaceTranses.enabled'),$coordinatePointService->is_active??null, ['class' => 'form-control']) !!}
    </div>
</div>
