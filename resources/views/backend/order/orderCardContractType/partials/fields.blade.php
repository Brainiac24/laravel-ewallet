<div class="form-group required">
    {!! Form::label('code_map', trans('orderCardContractType.backend.code_map').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('code_map', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group required">
    {!! Form::label('name', trans('orderCardContractType.backend.name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group ">
    {!! Form::label('percentage', trans('orderCardContractType.backend.percentage').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::number('percentage', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('month', trans('orderCardContractType.backend.month').':', ['class' => 'control-label col-sm-2', 'min' => 0, 'max' => 100]) !!}
    <div class='col-sm-9'>
        {!! Form::number('month', null, ['class' => 'form-control', 'min' => 1, 'max' => 12]) !!}
    </div>
</div>
<div class="form-group required">
    {!! Form::label('is_active', trans('orderCardContractType.backend.is_active').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('is_active', trans("InterfaceTranses.is_active") ,null) !!}
    </div>
</div>

