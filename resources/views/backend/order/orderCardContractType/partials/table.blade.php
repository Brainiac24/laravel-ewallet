@foreach($orderCardContractTypes as $item)
    {
    recid: '{{$item->id}}',
    code_map: '{{$item->code_map}}',
    name: '{{$item->name}}',
    percentage: '{{$item->percentage}}%',
    month: '{{$item->month}}',
    is_active: '{{trans('InterfaceTranses.is_active.'.$item->is_active)}}'
    },
@endforeach