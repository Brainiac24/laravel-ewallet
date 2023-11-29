@foreach($data as $item)
    {
    recid: '{{$item->id}}',
    code: '{{$item->code}}',
    name: '{{$item->name}}',
    is_active: '{{trans('InterfaceTranses.is_active.'.$item->is_active)}}',
    updated_at:'{{ $item->updated_at}}',
    created_at:'{{ $item->created_at}}',
    },
@endforeach