@foreach($merchantUsers as $item)
    {
    recid: '{{$item->id ?? null}}',
    merchant_address: '{{$item->merchant->address??null}}',
    merchant_name: '{{$item->merchant->name??null}}',
    user_fullname: '{{$item->user->fullNameExtendedFormat??null}}',
    user_msisdn: '{{$item->user->msisdn??null}}',
    account_number: '{{$item->account->number??null}}',
    merchant_inn: '{{$item->merchant->inn??null}}',
    merchant_account_number: '{{$item->merchant->account_number??null}}',
    merchant_city: '{{isset($item->merchant->city)?($item->merchant->city->name??null):null}}',
    is_active: '{{trans('InterfaceTranses.is_active.'.$item->is_active) }}',
    is_approved: '{{trans('InterfaceTranses.is_active.'.$item->is_approved) }}',
    updated_at: '{{ empty($item->updated_at)?null:\Carbon\Carbon::parse($item->updated_at)->format("d.m.Y H:i:s")}}',
    created_at: '{{ empty($item->created_at)?null:\Carbon\Carbon::parse($item->created_at)->format("d.m.Y H:i:s")}}',
    },
@endforeach
