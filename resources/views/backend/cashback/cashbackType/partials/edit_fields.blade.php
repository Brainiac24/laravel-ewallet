<div class="form-group required">
    {!! Form::label('code', trans('cashbackType.backend.code').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('code', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group required">
    {!! Form::label('name', trans('cashbackType.backend.name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group required">
    {!! Form::label('is_active', trans('cashbackType.backend.is_active').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('is_active', trans('InterfaceTranses.enabled') , $documentType->is_active??null, ['class' => 'form-control']) !!}
    </div>
</div>