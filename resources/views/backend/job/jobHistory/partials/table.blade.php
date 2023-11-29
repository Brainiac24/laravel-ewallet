@foreach($jobHistory as $item)
    {
    recid: '{{$item->id}}',
    name: '{{$item->name}}',
    created_user: '{{$item->createdBy->username??''}}',
    created_at:'{{ $item->created_at}}',
    type:'{{ $item->type}}',
    processed_at:'{{ $item->processed_at}}',
    finished_at:'{{ $item->finished_at}}',
    status_id:'{{$item->status}}',
    status:'{{ trans("InterfaceTranses.job_history_status")[$item->status] ?? null}}',
    link:'{{$item->filename}}',
    },
@endforeach