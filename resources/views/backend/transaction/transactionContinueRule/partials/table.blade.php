@foreach($transactionContinueRules as $item)
    {
    recid: '{{$item->id}}',
    transaction_status_id: '{{$item->transaction_status->name}}',
    transaction_sync_status_id: '{{$item->transaction_sync_status->name}}',
    from_gateway_id: '{{$item->from_gateway->name}}',
    to_gateway_id: '{{$item->to_gateway->name}}',
    is_active: '{{trans('InterfaceTranses.is_active.'.$item->is_active) }}',
    updated_at: '{{ empty($item->updated_at)?null:\Carbon\Carbon::parse($item->updated_at)->format("d.m.Y H:i:s")}}',
    created_at: '{{ empty($item->created_at)?null:\Carbon\Carbon::parse($item->created_at)->format("d.m.Y H:i:s")}}',

    @if(count($item->transaction_continue_rule_accordance)>0)
            <?php
                $nameTransactionStatusSync = '';
                $nameTransactionStatus = '';
                foreach ($item->transaction_continue_rule_accordance as $value){
                    $nameTransactionStatus .= isset($filterTransactionStatus[$value->transaction_status_id])?$filterTransactionStatus[$value->transaction_status_id].'; ':'';
                    $nameTransactionStatusSync .= isset($filterTransactionSyncStatus[$value->transaction_sync_status_id])?$filterTransactionSyncStatus[$value->transaction_sync_status_id].'; ':'';
                }
                echo 'transaction_continue_rule_accordance_status:'. "'".$nameTransactionStatus."',";
                echo 'transaction_continue_rule_accordance_status_sync:'."'". $nameTransactionStatusSync."',";
           ?>
    @else
        transaction_continue_rule_accordance_status: '',
        transaction_continue_rule_accordance_status_sync: ''
    @endif

    },
@endforeach