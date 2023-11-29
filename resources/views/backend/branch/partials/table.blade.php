@foreach($branches as $item)
    {
    recid: '{{$item->id}}',
    code: '{{$item->code}}',
    code_map: '{{$item->code_map}}',
    name: '{{$item->name}}',
    acc_number: '{{$item->acc_number}}',
    address: '{{$item->address}}',
    city_name: '{{$item->city_name}}',
    branch_user_id: '{{$item->branch_user_id}}',
    is_active: '{{trans('InterfaceTranses.is_active.'.$item->is_active)}}',
    updated_at:'{{ $item->updated_at}}',
    created_at:'{{ $item->created_at}}',
    },
@endforeach