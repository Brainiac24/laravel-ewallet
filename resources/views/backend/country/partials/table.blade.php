@foreach($data as $item)
    {
    recid: '{{$item->id}}',
    code: '{{$item->code}}',
    code_map: '{{$item->code_map}}',
    name: '{{$item->name}}',
    iso_2: '{{$item->iso_2}}',
    iso_3: '{{$item->iso_3}}',
    desc: '{{$item->desc}}',
    is_active: '{{trans('InterfaceTranses.is_active.'.$item->is_active)}}',
    updated_at:'{{ $item->updated_at}}',
    created_at:'{{ $item->created_at}}',
    {{--@if ($item['id']===false)--}}
        {{--"w2ui": { "style": "color: red" },--}}
    {{--@endif--}}
    {{--@if ($item['id']===false)--}}
        {{--"w2ui": { "style": "background-color: #C2F5B4" }--}}
    {{--@endif--}}
    },
@endforeach