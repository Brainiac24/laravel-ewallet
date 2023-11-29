<div class="form-group">
    {!! Form::label('merchant_id', 'Мерчанты', ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::select('merchant_id', $merchantList, ['class'=>'form-control']) !!}
    </div>
</div>
