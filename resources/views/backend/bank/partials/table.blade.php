@foreach($banks as $item)
    {
    recid: '{{$item->id}}',
    code: '{{$item->code}}',
    code_map: '{{$item->code_map}}',
    name: '{{$item->name}}',
    {{--    desc: '{{$item->desc}}',--}}
    bic: '{{$item->bic}}',
    corr_acc: '{{$item->corr_acc}}',
    position: '{{$item->position}}',
    is_active: '{{trans('InterfaceTranses.is_active.'.$item->is_active)}}',
    updated_at:'{{ $item->updated_at}}',
    created_at:'{{ $item->created_at}}',
    },
@endforeach