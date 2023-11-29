@foreach($schedules as $item)
    {
        recid: '{{$item->id}}',
        name: '{{ $item->name}}',
        cron_expression:'{{ $item->cron_expression}}',
        create_by_user_id:'{{ $item->createByUser->fullNameExtendedFormat}}',
        schedule_type_id:'{{ $item->scheduleType->name}}',
        is_active: '{{trans('InterfaceTranses.is_active.'.$item->is_active)}}',
        updated_at:'{{ $item->updated_at}}',
        created_at:'{{ $item->created_at}}',
    },
@endforeach
