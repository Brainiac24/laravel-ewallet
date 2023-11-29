@foreach($transactionStatuses as $item)
    {   recid: '{{$item->id}}',
    code: '{{$item->code}}',
    name: '{{$item->name}}',
    color: '{{$item->color}}',
    transaction_status_group_id: '{{$item->transaction_status_group->name}}',
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
