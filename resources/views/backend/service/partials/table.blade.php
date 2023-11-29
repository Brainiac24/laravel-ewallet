@foreach($service as $item)
    {   recid: '{{$item->id}}',

{{--    code: '<a href="services/{{$item->id}}">{{(string)$item->code }}</a>',--}}
    code: '{{(string)$item->code }}',
    code_map: '{{(string)$item->code_map }}',
    photo: '<img src="{{ \App\Services\Common\Helpers\Helper::asset().config('app_settings.service_icons_url_host').'/hdpi/'.$item->icon_url }}" height="15px" width="15px" alt="">',
    name: '{{(string)$item->name }}',
    is_active: '{{trans('InterfaceTranses.is_active.'.$item->is_active) }}',
    position: '{{$item->position }}',
    min_amount: '{{$item->min_amount }}',
    max_amount: '{{$item->max_amount }}',
    commission: '{{$item->commission->name??null }}',
    currency_iso_name: '{{$item->currency->iso_name}}',
    currency_rate_category_name: '{{$item->currency_rate_category->name}}',
    service_limit: '{{$item->service_limit->name??null }}',
    service_otp_limit: '{{$item->service_otp_limit->name??null }}',
    workday_id: '{{$item->workday->name??null }}',
    gateway_id: '{{$item->gateway->name }}',
    is_to_accountable: '{{trans('InterfaceTranses.yesno.'.$item->is_to_accountable) }}',
    requestable_balance_params: '{{$item->requestable_balance_params }}',
    processing_code: '{{$item->processing_code }}',
    params_json: '{{json_encode($item->params_json, JSON_UNESCAPED_UNICODE) }}',
    extend_params_json: '{{json_encode($item->extend_params_json, JSON_UNESCAPED_UNICODE) }}',
    is_enabled_for_account: '{{$item->is_enabled_for_account }}',
    is_enabled_for_service: '{{$item->is_enabled_for_service }}',
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