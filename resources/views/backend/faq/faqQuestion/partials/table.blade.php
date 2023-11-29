@foreach($FAQQuestions as $item)
    {
    recid: '{{$item->id}}',
    title: '{{$item->title}}',
{{--    parent_id: '{{$item->parent_id}}',--}}
    position: '{{$item->position}}',
    is_active: '{{trans('InterfaceTranses.is_active.'.$item->is_active)}}',
    updated_at:'{{ $item->updated_at}}',
    created_at:'{{ $item->created_at}}',
    },
@endforeach