@foreach($data as $item)
    {   recid: '{{$item->id}}',
    name: '{{$item->name}}',
    monday: '{{$item->monday}}',
    tuesday: '{{$item->tuesday}}',
    wednesday: '{{$item->wednesday}}',
    thursday: '{{$item->thursday}}',
    friday: '{{$item->friday}}',
    saturday: '{{$item->saturday}}',
    sunday: '{{$item->sunday}}',
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
