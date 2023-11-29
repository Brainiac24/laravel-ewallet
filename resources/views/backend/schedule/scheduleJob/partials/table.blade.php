@foreach($scheduleJobs as $item)
    {
    recid: '{{$item->id}}',
    job: '{{ $scheduleTypes[$item->displayName]->name??$item->displayName}}',
    available_at:'{{ $item->available_at }}',
    created_at:'{{$item->created_at}}',
    },
@endforeach
