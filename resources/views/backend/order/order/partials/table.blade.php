@foreach($orders as $item)
    {
    recid: '{{$item->id}}',
    order_type_id: '{{$item->order_type->name}}',
    number: '{{$item->number}}',
    from_user_id: '{{$item->from_user->username ?? ""}}',
    from_user_full_name: '{{$item->from_user->fullNameExtendedFormat ?? ""}}',
    to_user_id: '{{$item->to_user->username ?? ""}}',
    entity_type: '{{$item->entity_type}}',
    entity_id: '{{$item->entity_id}}',
    payload_params_json: '{{json_encode($item->payload_params_json,JSON_UNESCAPED_UNICODE)}}',
    response: '{{json_encode($item->response,JSON_UNESCAPED_UNICODE)}}',
    order_status_id: '{{$item->order_status->name ?? ""}}',
    order_process_status_id: '{{$item->order_process_status->name ?? ""}}',
    updated_at:'{{ $item->updated_at}}',
    created_at:'{{ $item->created_at}}',
    @if (isset($item->order_status->color))
        "w2ui": { "style": "background-color: {{$item->order_status->color}}" },
    @endif
    },
@endforeach