@foreach($data as $item)
{
    recid: '{{$item->id ?? null}}',
    name: '{{$item->name}}',
    start_date: '{{$item->start_date}}',
    end_date: '{{$item->end_date}}',
{{--    is_popular: '{{trans('InterfaceTranses.yesno.'.$item->is_popular) }}',--}}
    is_active: '{{trans('InterfaceTranses.is_active.'.$item->is_active) }}',
    updated_at: '{{$item->updated_at}}',
    created_at: '{{$item->created_at}}',
},
@endforeach