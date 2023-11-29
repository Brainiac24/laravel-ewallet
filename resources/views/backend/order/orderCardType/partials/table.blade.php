@foreach($orderCardTypes as $item)
    {
    recid: '{{$item->id}}',
    code_map: '{{$item->code_map}}',
    name: '{{$item->name}}',
    price: '{{$item->price}}',
    currency: '{{$item->currency->iso_name ?? ''}}',
    year: '{{(int)$item->year}} год',
    position: '{{(int)$item->position}}',
    is_active: '{{trans('InterfaceTranses.is_active.'.$item->is_active)}}'
    },
@endforeach