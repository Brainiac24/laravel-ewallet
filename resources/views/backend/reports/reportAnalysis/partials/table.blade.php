@foreach($reportAnalyzes as $item)
    {
    recid: '{{$item->id}}',
    name: '{{$item->name}}',
    is_active: '{{  trans('InterfaceTranses.is_active.'.$item->is_active) }}',
    updated_at: '{{(string)$item->updated_at }}',
    created_at:'{{ $item->created_at}}',
    },
@endforeach