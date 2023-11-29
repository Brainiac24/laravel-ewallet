@foreach($currencyRates as $item)
    {   recid: '{{$item->id}}',
    code: '{{$item->currency->code}}',
    name: '{{$item->currency->name}}',
    short_name: '{{$item->currency->short_name}}',
    iso_name: '{{$item->currency->iso_name}}',
    symbol_left: '{{$item->currency->symbol_left}}',
    symbol_right: '{{$item->currency->symbol_right}}',
    is_primary: '{{trans('InterfaceTranses.yesno.'.$item->currency->is_primary)}}',
    is_active: '{{trans('InterfaceTranses.is_active.'.$item->currency->is_active)}}',
    currency_rate_category_name: '{{$item->currency_rate_category->name}}',
    value_sell: '{{$item->value_sell}}',
    value_buy: '{{$item->value_buy}}',
    updated_at: '{{$item->updated_at}}',
    created_at: '{{$item->created_at}}',

    @if ($item->currency->is_active===0)
        "w2ui": { "style": "background-color: #FF0000" }
    @endif
    },
@endforeach

