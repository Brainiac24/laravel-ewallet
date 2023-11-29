<!-- Name Field -->
<div class="form-group required">
    {!! Form::label('name', trans('commission.backend.name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-6'>
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>

