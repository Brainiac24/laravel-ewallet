@foreach($news as $item)
    {
    recid: '{{$item->id}}',
    title: '{{$item->title}}',
    short_description: '{{$item->short_description}}',
{{--    description: '{{json_encode($item->description,JSON_UNESCAPED_UNICODE)}}',--}}
{{--    description: "{!! $item->description !!}",--}}
    tags: '{{$item->tags}}',
    position: '{{$item->position}}',
    is_active: '{{trans('InterfaceTranses.is_active.'.$item->is_active)}}',
    updated_at:'{{ $item->updated_at}}',
    created_at:'{{ $item->created_at}}',
    },
@endforeach