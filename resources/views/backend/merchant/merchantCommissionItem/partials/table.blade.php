@foreach($merchantCommissionItems as $item)
    {
        recid: '{{$item->id}}',
        name: '{{$item->name}}',
        min: '{{$item->min}}',
        max: '{{$item->max}}',
        value: '{{$item->value}}',
        is_percentage: '{{trans('InterfaceTranses.yesno.'.$item->is_percentage) }}',
        merchant_commission_id: '{{$item->merchant_commission->name ?? ''}}',
        is_active: '{{trans('InterfaceTranses.is_active.'.$item->is_active) }}',
        updated_at: '{{$item->updated_at}}',
        created_at: '{{$item->created_at}}',
    },
@endforeach