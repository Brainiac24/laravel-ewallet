@foreach($depositOpeningOrders as $order)
    {
    recid: '{{$order->id}}',
    order_type_id: '{{$order->order_type->name}}',
    number: '{{$order->number}}',
    from_user_id: '{{$order->from_user->username ?? ""}}',
    from_user_full_name: '{{$order->from_user->fullNameExtendedFormat ?? ""}}',
    to_user_id: '{{$order->to_user->username ?? ""}}',
    entity_type: '{{$order->entity_type}}',
    entity_id: '{{$order->entity_id}}',
    payload_params_json: '{{json_encode($order->payload_params_json,JSON_UNESCAPED_UNICODE)}}',
    response: '{{json_encode($order->response,JSON_UNESCAPED_UNICODE)}}',
    order_status_id: '{{$order->order_status->name ?? ""}}',
    order_process_status_id: '{{$order->order_process_status->name ?? ""}}',
    updated_at:'{{ $order->updated_at}}',
    created_at:'{{ $order->created_at}}',
    @if (isset($order->order_status->color))
        "w2ui": { "style": "background-color: {{$order->order_status->color}}" },
    @endif
    },
@endforeach