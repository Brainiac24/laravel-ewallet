@foreach($replenishmentEwalletEskhataTransactions as $item)
    {
        recid: '{{$item->id}}',
        number: '{{ $item->number }}',
        transaction_type_id: '{{ $item->transaction_type->name}}',
        transaction_status_group_id: '{{ $item->transaction_status->transaction_status_group->name }}',
        transaction_status_id: '{{ $item->transaction_status->name }}',
        amount: '{{ $item->amount }}',
        commission: '{{ $item->commission }}',
        balance: '{{ $item->balance}}',
        blocked_balance: '{{ $item->blocked_balance}}',
        currency_id: '{{ $item->currency->name}}',
        currency_rate_value: '{{ $item->currency_rate_value}}',
        msisdn:'{{ $item->user->msisdn}}',
        account_type_id: '{{ $item->account_type->name}}',
        transaction_session_number: '{{ $item->transaction->session_number}}',
        created_at: '{{empty($item->created_at)?null:\Carbon\Carbon::parse($item->created_at)->format("d.m.Y H:i:s")}}'
    },
@endforeach