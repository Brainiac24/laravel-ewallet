<div class="form-group">
    {!! Form::label('id', trans('merchantItem.backend.id'), ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('id', null, ['class'=>'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('name', trans('merchantItem.backend.name'), ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('name', null, ['class'=>'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('merchant_id', trans('merchantItem.backend.merchant_id'), ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::select('merchant_id', [''=>'']+ $filterMerchants, ['class'=>'form-control']) !!}
    </div>
</div>
