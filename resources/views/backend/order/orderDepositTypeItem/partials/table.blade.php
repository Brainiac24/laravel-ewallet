@foreach($orderDepositTypeItems as $item)
    {
        recid: '{{$item->id}}',
        code: '{{$item->code}}',
        code_map: '{{$item->code_map}}',
        name: '{{$item->name}}',
        min_amount: {{ $item->min_amount }},
        max_amount: {{ $item->max_amount }},
        day_from_count: {{ $item->day_from_count }},
        day_to_count: {{ $item->day_to_count }},
        percentage: {{ $item->percentage }},
        can_fill_until: {{ $item->can_fill_until }},
        can_fill_until_is_persentage: '{{ trans('InterfaceTranses.yesno.'.$item->can_fill_until_is_persentage) }}',
        currency_name: '{{ $item->currency->iso_name ?? '' }}',
        order_deposit_type_name: '{{ $item->order_deposit_type->name ??'' }}',
        position: {{ $item->position }},
        is_fillable: '{{ trans('InterfaceTranses.yesno.'.$item->is_fillable) }}',
        is_withdrawable: '{{ trans('InterfaceTranses.yesno.'.$item->is_withdrawable)}}',
        is_active: '{{trans('InterfaceTranses.is_active.'.$item->is_active)}}',
        created_at: '{{$item->created_at}}',
        updated_at: '{{$item->updated_at}}',

    },
@endforeach