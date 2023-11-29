@foreach($data as $item)
    {
    recid: '{{$item->id}}',
    code: '{{$item->code}}',
    name: '{{$item->name}}',
    color: '{{$item->color}}',
    updated_at:'{{ $item->updated_at}}',
    created_at:'{{ $item->created_at}}',
    },
@endforeach