<!-- code Field -->
<div class="form-group required">
    {!! Form::label('code', trans('transactionStatus.backend.code').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('code', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- name Field -->
<div class="form-group required">
    {!! Form::label('name', trans('transactionStatus.backend.name').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- params_json Field -->
<div class="form-group required">
    {!! Form::label('color', trans('transactionStatus.backend.color').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::text('color', null, ['class' => 'form-control']) !!}
    </div>
</div>
<!-- params_json Field -->
<div class="form-group required">
    {!! Form::label('transaction_status_group', trans('transactionStatus.backend.transaction_status_group_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        {!! Form::select('transaction_status_group_id', $transactionStatusGroups , $selectedStatusGroup??null ,['class' => 'form-control']) !!}
    </div>
</div>