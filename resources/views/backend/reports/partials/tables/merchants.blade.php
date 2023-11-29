{{--records:--}}
{{--{!! json_encode($merchants, JSON_UNESCAPED_UNICODE) !!}--}}
@foreach($merchants as $item)
{
    recid: '{{$item->id ?? null}}',
    name: '{{$item->name}}',
    account_number: '{{$item->account_number}}',
    address: '{{$item->city}}',
    address: '{{$item->address}}',
    merchant_cashback_id: '{{$item->merchant_cashback->name??null}}',
    bank_cashback_id: '{{$item->bank_cashback->name??null}}',
    workday: '{{$item->merchant_workday->name??null}}',
    merchant_commission_id: '{{$item->merchant_commission->name??null}}',
    bank_id: '{{$item->bank->name??null}}',
    city_id: '{{$item->city->name??null}}',
    phone: '{{$item->phone}}',
    email: '{{$item->email}}',
    inn: '{{$item->inn}}',
    img_logo: '{{$item->img_logo}}',
    img_ad: '{{$item->img_ad}}',
    img_detail: '{{$item->img_detail}}',
    position: '{{$item->position}}',
    account_number: '{{$item->account_number}}',
    is_active: '{{trans('InterfaceTranses.is_active.'.$item->is_active) }}',
    updated_at: '{{ empty($item->updated_at)?null:\Carbon\Carbon::parse($item->updated_at)->format("d.m.Y H:i:s")}}',
    created_at: '{{ empty($item->created_at)?null:\Carbon\Carbon::parse($item->created_at)->format("d.m.Y H:i:s")}}',
},
@endforeach