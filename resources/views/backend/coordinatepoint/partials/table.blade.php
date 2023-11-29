@foreach($coordinatePoints as $item)
    {   recid: '{{$item->id}}',
    is_active: '{{config('coordinatepoint.status')[$item->is_active]  }}',
    name:'{{ $item->name}}',
    address:'{{ $item->address }}',
    longitude:'{{ $item->longitude}}',
    latitude:'{{ $item->latitude}}',
    coordinate_point_workday_id:'{{ $item->coordinate_point_workday->name??''}}',
    coordinate_point_type_id:'{{ $item->coordinate_point_type->name??''}}',
    merchant_id:'{{ $item->merchant->name??''}}',
    object_type:'{{ config('coordinatepoint.names')[$item->object_type] }}',
    coordinate_point_city_id: '{{$item->coordinate_point_city->city->name}}',
    updated_at:'{{ $item->updated_at}}',
    created_at:'{{ $item->created_at}}',
    @if ($item->is_active===false)
        "w2ui": { "style": "color: red" },
    @endif
    @if ($item->is_editable===false)
        "w2ui": { "style": "background-color: #C2F5B4" }
    @endif
    },
@endforeach

