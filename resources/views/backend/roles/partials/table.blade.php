@foreach($roles as $item)
    {   recid: '{{$item->id}}',

{{--    display_name:'<a href="roles/{{ $item->id}}">{{ $item->display_name}}</a>',--}}
    display_name:'{{ $item->display_name}}',
    code:'{{ $item->name}}',
    description:'{{ $item->description}}',
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