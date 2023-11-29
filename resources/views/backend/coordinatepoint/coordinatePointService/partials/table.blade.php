@foreach($coordinatePointServices as $item)
    {   recid: '{{$item->id}}',
    name: '{{$item->name}}',
    position: '{{$item->position}}',
    is_show_for_filter: '{{trans('InterfaceTranses.verified.'.$item->is_show_for_filter)}}',
    is_active: '{{trans('InterfaceTranses.is_active.'.$item->is_active)}}',
    updated_at:'{{ $item->updated_at}}',
    created_at:'{{ $item->created_at}}',
    },
@endforeach
