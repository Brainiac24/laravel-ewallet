@foreach($coordinatePointTypes as $item)
    {   recid: '{{$item->id}}',
    name: '{{$item->name}}',
    code: '{{$item->code}}',
    coordinate_point_workday_id: '{{$item->coordinate_point_workday->name}}',
    position: '{{$item->position}}',
    is_show_for_filter: '{{trans('InterfaceTranses.verified.'.$item->is_show_for_filter)}}',
    is_active: '{{trans('InterfaceTranses.is_active.'.$item->is_active)}}',
    updated_at:'{{ $item->updated_at}}',
    created_at:'{{ $item->created_at}}',
    },
@endforeach
