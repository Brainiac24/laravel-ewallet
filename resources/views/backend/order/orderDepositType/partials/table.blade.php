@foreach($orderDepositTypes as $item)
    {
        recid: '{{$item->id}}',
        code: '{{$item->code}}',
        code_map: '{{$item->code_map}}',
        name: '{{$item->name}}',
        service_name: '{{$item->service->name ?? ''}}',
        icon: '{{$item->icon}}',
        position: '{{$item->position}}',
        contract_html: `{{str_replace("\r\n", '',$item->contract_html)}}`,
        detail_params_html: `{{str_replace("\r\n", '',$item->detail_params_html)}}`,
        is_active: '{{trans('InterfaceTranses.is_active.'.$item->is_active)}}',
        created_at: '{{$item->created_at}}',
        updated_at: '{{$item->updated_at}}',
    },
@endforeach