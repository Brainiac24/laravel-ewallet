<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
        <th style="width: 1px;">
            <input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);">
        </th>
        <th>{{ trans('transactionHistory.backend.table.from_account_id') }}</th>
        <th>{{ trans('transactionHistory.backend.table.to_account_id') }}</th>
        <th>{{ trans('transactionHistory.backend.table.service_id') }}</th>
        <th>{{ trans('transactionHistory.backend.table.amount') }}</th>
        <th>{{ trans('transactionHistory.backend.table.amount_all') }}</th>
        <th>{{ trans('transactionHistory.backend.table.params_json') }}</th>
        <th>{{ trans('transactionHistory.backend.table.session_number') }}</th>
        <th>{{ trans('transactionHistory.backend.table.transaction_type_id') }}</th>
        <th>{{ trans('transactionHistory.backend.table.finished_at') }}</th>
        <th>{{ trans('transactionHistory.backend.table.next_try_at') }}</th>
        <th>{{ trans('transactionHistory.backend.table.created_by_user_id') }}</th>
        <th>{{ trans('transactionHistory.backend.table.transaction_status_id') }}</th>
        <th>{{ trans('transactionHistory.backend.table.transaction_status_detail_id') }}</th>
        <th>{{ trans('transactionHistory.backend.table.try_count') }}</th>
        <th>{{ trans('transactionHistory.backend.table.flag') }}</th>
        <th>{{ trans('transactionHistory.backend.table.currency_rate_value') }}</th>
        <th>{{ trans('transactionHistory.backend.table.currency_iso_name') }}</th>
        <th>{{ trans('transactionHistory.backend.table.account_balance') }}</th>
        </thead>
        <tbody>
            @foreach($transactionHistories as $item)
            <tr>
                <td><input type="checkbox" name="selected[]" value="{{ $item->id }}"></td>
                <td>{{ $item->from_account->number}}</td>
                <td>{{ $item->to_account->number??null}}</td>
                <td>{{ $item->service->name}}</td>
                <td>{{  link_to(route('admin.transactions.histories.show', [$item->id]), $item->amount) }}</td>
                <td>{{ $item->amount_all}}</td>
                <td>{{ json_encode($item->params_json)}}</td>
                <td>{{ $item->session_number}}</td>
                <td>{{ $item->TransactionType->name}}</td>
                <td>{{ $item->finished_at}}</td>
                <td>{{ $item->next_try_at}}</td>
                <td>{{ $item->CreatedUser->msisdn}}</td>
                <td>{{ $item->TransactionStatus->name}}</td>
                <td>{{ $item->TransactionStatusDetail->name}}</td>
                <td>{{ $item->try_count}}</td>
                <td>{{ $item->flag}}</td>
                <td>{{ $item->currency_rate_value}}</td>
                <td>{{ $item->currency_iso_name}}</td>
                <td>{{ $item->account_balance}}</td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>

