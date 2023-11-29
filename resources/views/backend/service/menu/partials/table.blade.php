@foreach($menu as $item)
    {   recid: '{{$item['id']}}',
    photo: '<img src="{{ \App\Services\Common\Helpers\Helper::asset().config('app_settings.service_icons_url_host').'/hdpi/'.$item['icon_url'] }}" height="15px" width="15px" alt="">',
{{--    code: '<a href="{!! route('admin.menu.edit', [$item['id'], $item['category_id'], $item['position']]) !!}">{{(string)$item['service_name'] }}</a>',--}}
    code: '{{(string)$item['service_name'] }}',
    category_id:'{{ $item['category_id']}}',
    category_name:'{{ $item['category_name']}}',
    service_code:'{{ $item['service_code']}}',
    service_processing_code:'{{ $item['service_processing_code']}}',
    position:'{{ $item['position']}}',
    service_is_active:'{{ trans('InterfaceTranses.is_active.'.$item['service_is_active'])}}',
    service_updated_at:'{{ $item['service_updated_at']}}',
    updated_at:'{{ $item['updated_at']}}',
    created_at:'{{ $item['created_at']}}',

    @if ($item['id']===false)
        "w2ui": { "style": "color: red" },
    @endif
    @if ($item['id']===false)
        "w2ui": { "style": "background-color: #C2F5B4" }
    @endif

    },
@endforeach

