@foreach($data as $item)
    {   recid: '{{$item->id}}',
        name: '{{$item->name}}',
        is_active: '{{trans('InterfaceTranses.enabled.'.$item->is_active) }}',
        updated_at: '{{$item->updated_at}}',
        created_at: '{{$item->created_at}}',
    },
@endforeach