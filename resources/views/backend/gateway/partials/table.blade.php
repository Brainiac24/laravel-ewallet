@foreach($gateways as $item)
    {   recid: '{{$item->id}}',

    code: '{{(string)$item->code }}',
    {{--code: '<a href="gateways/{{$item->id}}">{{(string)$item->code }}</a>',--}}
    {{--name: '<a href="gateways/{{$item->id}}">{{(string)$item->name }}</a>',--}}
    name: '{{(string)$item->name }}',
    params_json: '{{(string)$item->params_json }}',
    is_active: '{{trans('InterfaceTranses.is_active.'.$item->is_active) }}',
    is_enabled_for_account: '{{trans('InterfaceTranses.enabled.'.$item->is_enabled_for_account) }}',
    is_enabled_for_service: '{{trans('InterfaceTranses.enabled.'.$item->is_enabled_for_service) }}',
    updated_at:'{{ $item->updated_at}}',
    created_at:'{{ $item->created_at}}',
    @if ($item->is_active===false)
        "w2ui": { "style": "color: red" },
    @endif
    @if ($item->is_editable===false)
        "w2ui": { "style": "background-color: #C2F5B4" }
    @endif

    },
@endforeach

