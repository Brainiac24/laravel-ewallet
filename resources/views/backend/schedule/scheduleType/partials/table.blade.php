@foreach($scheduleTypes as $item)
    {
        recid: '{{$item->id}}',
        name: '{{$item->name}}',
        type: '{{$item->type}}',
        value: '{{$item->value}}',
        is_active: '{{trans('InterfaceTranses.is_active.'.$item->is_active)}}',
        updated_at:'{{ $item->updated_at}}',
        created_at:'{{ $item->created_at}}',
    },
@endforeach
