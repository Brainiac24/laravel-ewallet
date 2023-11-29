<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
        <th style="width: 1px;">
            <input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);">
        </th>
        <th>{{ trans('accountHistory.backend.table.number') }}</th>
        <th>{{ trans('accountHistory.backend.table.balance') }}</th>
        <th>{{ trans('accountHistory.backend.table.account_type_id') }}</th>
        <th>{{ trans('accountHistory.backend.table.user_id') }}</th>
        <th>{{ trans('accountHistory.backend.table.currency_id') }}</th>

        <th>{{ trans('accountHistory.backend.table.currency_rate_value') }}</th>
        <th>{{ trans('accountHistory.backend.table.created_at') }}</th>
        <th>{{ trans('accountHistory.backend.table.updated_at') }}</th>
        </thead>
        <tbody>
            @foreach($accountHistory as $item)
            <tr>
                <td><input type="checkbox" name="selected[]" value="{{ $item->id }}"></td>
                <td>{{  link_to(route('admin.accounts.histories.show', [$item->id]), $item->number) }}</td>
                <td>{{ $item->balance}}</td>
                <td>{{ $item->account_type->name}}</td>
                <td>{{ $item->user->msisdn}}</td>
                <td>{{ $item->currency->name}}</td>
                <td>{{ $item->currency_rate_value}}</td>
                <td>{{ $item->created_at}}</td>
                <td>{{ $item->updated_at}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

