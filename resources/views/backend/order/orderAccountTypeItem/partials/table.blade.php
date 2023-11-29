@foreach($orderAccountTypeItems as $item)
    {
        recid: '{{$item->id}}',
        code: '{{$item->code}}',
        code_map: '{{$item->code_map}}',
        name: '{{$item->name}}',
        currency_name: '{{ $item->currency->iso_name ?? '' }}',
        order_account_type_name: '{{ $item->order_account_type->name ??'' }}',
        position: {{ $item->position }},
        is_active: '{{trans('InterfaceTranses.is_active.'.$item->is_active)}}',
        created_at: '{{$item->created_at}}',
        updated_at: '{{$item->updated_at}}',

    },
@endforeach