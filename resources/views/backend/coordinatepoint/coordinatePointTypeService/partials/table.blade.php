@foreach($coordinatePointTypeServices as $item)
    {
    recid: '{{$item->id}}',
    coordinate_point_type_id: '{{$item->coordinate_point_type->name}}',
    coordinate_point_service_id: '{{$item->coordinate_point_service->name}}',
    is_active: '{{trans('InterfaceTranses.is_active.'.$item->is_active)}}',
    updated_at:'{{ $item->updated_at}}',
    created_at:'{{ $item->created_at}}',
    },
@endforeach