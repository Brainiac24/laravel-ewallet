@foreach($regions as $item)
    {
    recid: '{{$item->id}}',
    code: '{{$item->code}}',
    code_map: '{{$item->code_map}}',
    name: '{{$item->name}}',
    desc: '{{$item->desc}}',
    is_active: '{{trans('InterfaceTranses.is_active.'.$item->is_active)}}',
    country_id: '{{$item->country->name}}',
    updated_at:'{{ $item->updated_at}}',
    created_at:'{{ $item->created_at}}',
    },
@endforeach