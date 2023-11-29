@foreach($currencies as $item)
    {   recid: '{{$item->id}}',
    code: '{{$item->code}}',
    name: '{{$item->name}}',
    short_name: '{{$item->short_name}}',
    iso_name: '{{$item->iso_name}}',
    symbol_left: '{{$item->symbol_left}}',
    symbol_right: '{{$item->symbol_right}}',
    is_primary: '{{trans('InterfaceTranses.yesno.'.$item->is_primary)}}',
    is_active: '{{trans('InterfaceTranses.is_active.'.$item->is_active)}}',
    updated_at:'{{ $item->updated_at}}',
    created_at:'{{ $item->created_at}}',
    @if ($item['id']===false)
        "w2ui": { "style": "color: red" },
    @endif
    @if ($item['id']===false)
        "w2ui": { "style": "background-color: #C2F5B4" }
    @endif
    },
@endforeach
