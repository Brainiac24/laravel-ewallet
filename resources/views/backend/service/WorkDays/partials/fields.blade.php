<!-- Name Field -->
<div class="form-group required">
    {!! Form::label('name', trans('serviceworkdays.backend.name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- monday Field -->
<div class="form-group required">
    {!! Form::label('monday', trans('serviceworkdays.backend.monday').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('monday', null, ['class' => 'form-control','placeholder'=>'0-23']) !!}
    </div>
</div>
<!-- tuesday Field -->
<div class="form-group required" >
    {!! Form::label('tuesday', trans('serviceworkdays.backend.tuesday').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('tuesday', null, ['class' => 'form-control','placeholder'=>'0-23']) !!}
    </div>
</div>
<!-- wednesday Field -->
<div class="form-group required">
    {!! Form::label('wednesday', trans('serviceworkdays.backend.wednesday').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('wednesday', null, ['class' => 'form-control','placeholder'=>'0-23']) !!}
    </div>
</div>
<!-- thursday Field -->
<div class="form-group required">
    {!! Form::label('thursday', trans('serviceworkdays.backend.thursday').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('thursday', null, ['class' => 'form-control','placeholder'=>'0-23']) !!}
    </div>
</div>
<!-- friday Field -->
<div class="form-group required">
    {!! Form::label('friday', trans('serviceworkdays.backend.friday').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('friday', null, ['class' => 'form-control','placeholder'=>'0-23']) !!}
    </div>
</div>
<!-- saturday Field -->
<div class="form-group required">
    {!! Form::label('saturday', trans('serviceworkdays.backend.saturday').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('saturday', null, ['class' => 'form-control','placeholder'=>'0-23']) !!}
    </div>
</div>
<!-- sunday Field -->
<div class="form-group required">
    {!! Form::label('sunday', trans('serviceworkdays.backend.sunday').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('sunday', null, ['class' => 'form-control','placeholder'=>'0-23']) !!}
    </div>
</div>
