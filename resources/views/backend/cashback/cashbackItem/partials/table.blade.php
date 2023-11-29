@foreach($cashBackItems as $item)
{
    recid: '{{$item->id ?? null}}',
    name: '{{$item->name}}',
    min: '{{$item->min}}',
    max: '{{$item->max}}',
    value: '{{$item->value}}',
    {{--is_percentage: '{{$item->is_percantage}}',--}}
{{--    cashback_id: '{{$item->cashback->name}}',--}}
{{--    is_active: '{{trans('InterfaceTranses.is_active.'.$item->is_active) }}',--}}
is_percentage: '{{trans('InterfaceTranses.yesno.'.$item->is_percentage) }}',
    updated_at: '{{$item->updated_at}}',
    created_at: '{{$item->created_at}}',
},
@endforeach