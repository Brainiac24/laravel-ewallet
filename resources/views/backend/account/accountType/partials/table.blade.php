@foreach($accountTypes as $item)
    {   recid: '{{$item->id}}',
    code: '{{$item->code}}',
    code_map: '{{$item->code_map}}',
    name: '{{$item->name}}',
    gateway: '{{$item->gateway['name']}}',
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
