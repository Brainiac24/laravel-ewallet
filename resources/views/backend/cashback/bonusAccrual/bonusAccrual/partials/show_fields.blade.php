<div class="form-group">
    {!! Form::label('id', trans('bonusAccrual.backend.table.id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->id }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('code', trans('bonusAccrual.backend.table.cashback_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->cashback->name }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('name', trans('bonusAccrual.backend.table.user_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $data->user->getFullNameAttribute() }}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('is_active', trans('bonusAccrual.backend.table.bonus_accrual_status_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static">{{$data->bonus_accrual_status->name}}</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('created_at', trans('bonusAccrual.backend.table.transaction_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static"><a href="{{route('admin.transactions.show', $data->transaction_id)}}" target="_blank"> Перейти в транзакци</a></p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('created_at', trans('bonusAccrual.backend.table.order_id').':', ['class' => 'control-label col-sm-2']) !!}
    <div class='col-sm-9'>
        <p class="form-control-static"><a href="{{route('admin.orders.show', $data->order_id)}}" target="_blank"> Перейти в заявки</a></p>
    </div>
</div>
