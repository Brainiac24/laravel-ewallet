@foreach($colors as $item)
    {
    recid: '{{$item->id}}',
    code: '{{$item->code}}',
    color: '{{$item->color}}',
    is_active: '{{trans('InterfaceTranses.is_active.'.$item->is_active)}}',
    updated_at:'{{ $item->updated_at}}',
    created_at:'{{ $item->created_at}}',
    },
@endforeach