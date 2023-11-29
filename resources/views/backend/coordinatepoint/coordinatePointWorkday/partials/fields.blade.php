<!-- Name Field -->
<div class="form-group required">
    {!! Form::label('name', trans('coordinatePointWorkday.backend.name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- monday Field -->
<div class="form-group required">
    {!! Form::label('monday', trans('coordinatePointWorkday.backend.monday').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('monday', null, ['class' => 'form-control','placeholder'=>'0-23']) !!}
    </div>
</div>
<!-- tuesday Field -->
<div class="form-group required" >
    {!! Form::label('tuesday', trans('coordinatePointWorkday.backend.tuesday').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('tuesday', null, ['class' => 'form-control','placeholder'=>'0-23']) !!}
    </div>
</div>
<!-- wednesday Field -->
<div class="form-group required">
    {!! Form::label('wednesday', trans('coordinatePointWorkday.backend.wednesday').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('wednesday', null, ['class' => 'form-control','placeholder'=>'0-23']) !!}
    </div>
</div>
<!-- thursday Field -->
<div class="form-group required">
    {!! Form::label('thursday', trans('coordinatePointWorkday.backend.thursday').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('thursday', null, ['class' => 'form-control','placeholder'=>'0-23']) !!}
    </div>
</div>
<!-- friday Field -->
<div class="form-group required">
    {!! Form::label('friday', trans('coordinatePointWorkday.backend.friday').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('friday', null, ['class' => 'form-control','placeholder'=>'0-23']) !!}
    </div>
</div>
<!-- saturday Field -->
<div class="form-group required">
    {!! Form::label('saturday', trans('coordinatePointWorkday.backend.saturday').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('saturday', null, ['class' => 'form-control','placeholder'=>'0-23']) !!}
    </div>
</div>
<!-- sunday Field -->
<div class="form-group required">
    {!! Form::label('sunday', trans('coordinatePointWorkday.backend.sunday').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('sunday', null, ['class' => 'form-control','placeholder'=>'0-23']) !!}
    </div>
</div>

<!-- is_active Field -->
<div class="form-group required">
    {!! Form::label('is_active', trans('coordinatePointWorkday.backend.is_active').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('is_active', trans('InterfaceTranses.enabled'),$coordinatePointWorkday->is_active??null, ['class' => 'form-control']) !!}
    </div>
</div>
