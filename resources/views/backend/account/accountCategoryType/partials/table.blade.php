@foreach($accountCategoryTypes as $item)
    {   recid: '{{$item->id}}',
    code: '{{$item->code}}',
    name: '{{$item->name}}',
    img_uncolored: '{{$item->img_uncolored}}',
    img_colored: '{{$item->img_colored}}',
    position: '{{$item->position}}',
    parent_id: '{{$item->parent_id}}',
    updated_at:'{{ $item->updated_at}}',
    created_at:'{{ $item->created_at}}'
    },
@endforeach
