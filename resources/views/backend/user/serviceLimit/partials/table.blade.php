@foreach($userServiceLimits as $item)
    {
    recid: '{{$item->id}}',
    name: '{{$item->service->service_limit->name}}',
    {{--service_id: '<a href="../../services/limits/{{$item->service->service_limit->id}}/edit">{{$item->service->name}}</a>',--}}
    service_id: '{{$item->service->name}}',
    msisdn: '{{(string)$item->user->msisdn }}',
    params_json: '{{json_encode($item->params_json) }}',
    extend_params_json: '{{json_encode($item->extend_params_json, JSON_UNESCAPED_UNICODE) }}',
    full_name: '{{(string)$item->user->last_name}} {{(string)$item->user->first_name}} {{(string)$item->user->middle_name}}',
    updated_at: '{{(string)$item->updated_at }}',
    created_at:'{{ $item->created_at}}',
    @if ($item->is_active===false)
        "w2ui": { "style": "color: red" },
    @endif
    @if ($item->is_editable===false)
        "w2ui": { "style": "background-color: #C2F5B4" }
    @endif

    },
@endforeach

