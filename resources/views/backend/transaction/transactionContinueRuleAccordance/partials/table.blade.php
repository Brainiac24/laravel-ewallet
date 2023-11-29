@foreach($transactionContinueRuleAccordances as $item)
    {
    recid: '{{$item->id}}',
    transaction_status_id: '{{$item->transaction_status->name??''}}',
    transaction_continue_rule_id: '{{$item->transaction_continue_rule->name}}',
    transaction_sync_status_id: '{{$item->transaction_sync_status->name??''}}',
    message: '{{$item->message}}',
    is_active: '{{trans('InterfaceTranses.is_active.'.$item->is_active) }}',
    updated_at: '{{ empty($item->updated_at)?null:\Carbon\Carbon::parse($item->updated_at)->format("d.m.Y H:i:s")}}',
    created_at: '{{ empty($item->created_at)?null:\Carbon\Carbon::parse($item->created_at)->format("d.m.Y H:i:s")}}',
    },
@endforeach