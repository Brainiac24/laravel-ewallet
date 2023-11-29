@foreach($favorites as $item)
    {   recid: '{{$item->id}}',
    name: '{{$item->name}}',
    value: '{{$item->value}}',
    service: '{{$item->service->name}}',
    params_json: '{{json_encode($item->params_json)}}',
    user: '{{$item->user->msisdn}}',
    updated_at:'{{ $item->updated_at}}',
    created_at:'{{ $item->created_at}}',
    deleted_at:'{{ $item->deleted_at}}',
    @if ($item['id']===false)
        "w2ui": { "style": "color: red" },
    @endif
    @if ($item['id']===false)
        "w2ui": { "style": "background-color: #C2F5B4" }
    @endif
    @if ($item['deleted_at']!=null)
        "w2ui": { "style": "text-decoration: line-through;color:silver" }
    @endif
    },
@endforeach
