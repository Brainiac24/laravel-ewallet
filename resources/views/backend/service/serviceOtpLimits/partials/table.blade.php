@foreach($serviceOtpLimits as $item)
    {
    recid: '{{$item->id}}',
    code: '{{$item->code}}',
    name: '{{$item->name}}',
    {{--params_json: '{{json_encode($item->params_json,JSON_UNESCAPED_UNICODE)}}',--}}
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
