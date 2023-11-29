@foreach($merchantItems as $item)
    {
        recid: '{{$item->id}}',
        name: '{{$item->name}}',
        account_number: '{{$item->account_number}}',
        phone: '{{$item->phone}}',
        email: '{{$item->email}}',
        address: '{{$item->address}}',
        {{--merchant_id: '{{$item->merchant->name ?? ''}}',--}}
        {{--account_id: '{{$item->account_id}}',--}}
        is_active: '{{trans('InterfaceTranses.is_active.'.$item->is_active) }}',
        updated_at: '{{$item->updated_at}}',
        created_at: '{{$item->created_at}}',
    },
@endforeach