<!-- code Field -->
<div class="form-group required">
    {!! Form::label('code', trans('accountTypeDetail.backend.code').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('code', null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- name Field -->
<div class="form-group required">
    {!! Form::label('name', trans('accountTypeDetail.backend.name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- account_type_id Field -->
<div class="form-group required">
    {!! Form::label('account_type_id', trans('accountTypeDetail.backend.account_type_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('account_type_id', $accountTypeRepository, Route::is('admin.accounts.types-detail.create') ? null : $selectedAccountTypeId, ['name' => 'account_type_id', 'id' => 'account_type_id', 'class' => 'form-control select2 ', 'data-placeholder' => 'Выберите шлюз']) !!}
    </div>
</div>

