<div class="form-group">
    {!! Form::label('from_user_full_name', trans('bonusAccrual.backend.table.user_id'), ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::text('from_user_full_name', null, ['class'=>'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('bonus_accrual_status_id', trans('bonusAccrual.backend.table.bonus_accrual_status_id'), ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::select('bonus_accrual_status_id', [''=>'']+ $filterBonusAccrualStatus, ['class'=>'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('cashback_id', trans('bonusAccrual.backend.table.cashback_id'), ['class' => 'col-sm-5 control-label']) !!}
    <div class="col-sm-3">
        {!! Form::select('cashback_id',  [''=>'']+$filterCashback, ['class'=>'form-control']) !!}
    </div>
</div>

