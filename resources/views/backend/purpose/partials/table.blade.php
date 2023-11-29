@foreach($purposes as $item)
    {
    recid: "{{$item->id}}",
    code: '{{$item->code}}',
    code_map: '{{$item->code_map}}',
    name: '{{$item->name}}',
    desc: '{{$item->desc}}',
    is_active: '{{trans('InterfaceTranses.is_active.'.$item->is_active)}}',
    purpose_type_name: '{{$item->purpose_type->name}}',
    updated_at:'{{ $item->updated_at}}',
    created_at:'{{ $item->created_at}}',
    },
@endforeach