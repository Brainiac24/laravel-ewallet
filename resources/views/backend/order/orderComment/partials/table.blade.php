@foreach($orderComments as $item)
    {
    recid: '{{$item->id}}',
    short_name: '{{$item->short_name}}',
    name: '{{$item->name}}',
    desc: '{{$item->desc}}',
    order_type_id: '{{$item->order_type->name}}',
    code: '{{$item->code=='photo'?'Фотография':($item->code=='call'?'Вызов':'')}}',
    is_active: '{{trans('InterfaceTranses.is_active.'.$item->is_active)}}',
    updated_at:'{{ $item->updated_at}}',
    created_at:'{{ $item->created_at}}',
    },
@endforeach