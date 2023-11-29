@foreach($transactionTypes as $item)
    {   recid: '{{$item->id}}',
{{--    display_name:'<a href="{{url()->current()}}/{{ $item->id}}">{{ $item->name}}</a>',--}}
    display_name:'{{ $item->name}}',
    code:'{{ $item->code}}',
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
