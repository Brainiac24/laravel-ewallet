@foreach($bonusAccruals as $item)
    {
    recid: '{{$item->id}}',
    cashback_id: '{{$item->cashback->name}}',
    user_id: '{{$item->user->getFullNameAttribute()}}',
    order_id: '{{$item->order_id}}',
    transaction_id: '{{$item->transaction_id}}',
    bonus_accrual_status_id: '{{$item->bonus_accrual_status->name}}',
    updated_at:'{{ $item->updated_at}}',
    created_at:'{{ $item->created_at}}',
    },
@endforeach
