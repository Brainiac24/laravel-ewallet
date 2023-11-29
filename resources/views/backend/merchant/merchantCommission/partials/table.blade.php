@foreach($merchantCommissions as $item)
    {   recid: '{{$item->id}}',
        name: '{{$item->name}}',
        start_date: '{{$item->start_date}}',
        end_date: '{{$item->end_date}}',
        is_active: '{{trans('InterfaceTranses.enabled.'.$item->is_active) }}',
        updated_at: '{{$item->updated_at}}',
        created_at: '{{$item->created_at}}',
    },
@endforeach