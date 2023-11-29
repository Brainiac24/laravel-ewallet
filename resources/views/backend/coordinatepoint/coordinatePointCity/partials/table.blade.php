@foreach($coordinatePointCities as $item)
    {
        recid: '{{$item->id}}',
        is_active: '{{trans('InterfaceTranses.is_active.'.$item->is_active)}}',
        version:'{{ $item->version}}',
        city_id:'{{ $item->city->name }}',
        updated_at:'{{ $item->updated_at}}',
        created_at:'{{ $item->created_at}}',
    },
@endforeach