<!-- code Field -->
<div class="form-group required">
    {!! Form::label('code', trans('transactionStatusDetail.backend.code').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('code', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- name Field -->
<div class="form-group required">
    {!! Form::label('name', trans('transactionStatusDetail.backend.name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- params_json Field -->
<div class="form-group required">
    {!! Form::label('color', trans('transactionStatusDetail.backend.color').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('color', null, ['class' => 'form-control']) !!}
    </div>
</div>
