<div class="form-group">
    {!! Form::label('id', trans('bank.backend.table.id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $bank->id }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('code', trans('bank.backend.table.code').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $bank->code }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('code_map', trans('bank.backend.table.code_map').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $bank->code_map }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('name', trans('bank.backend.table.name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $bank->name }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('desc', trans('bank.backend.table.desc').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $bank->desc }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('bic', trans('bank.backend.table.bic').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $bank->bic }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('corr_acc', trans('bank.backend.table.corr_acc').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $bank->corr_acc }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('is_active', trans('bank.backend.table.is_active').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ trans('InterfaceTranses.is_active.'.$bank->is_active) }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('created_at', trans('bank.backend.table.created_at').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $bank->created_at }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('updated_at', trans('bank.backend.table.updated_at').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $bank->updated_at }}</p>
    </div>
</div>