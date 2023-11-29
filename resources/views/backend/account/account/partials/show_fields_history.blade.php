<div class="box box-solid ">
    <div class="box-header with-border greenClass">
        <h3 class="box-title">История Данного Счета</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                <th>{{ trans('accountHistory.backend.table.number') }}</th>
                <th>{{ trans('accountHistory.backend.table.transaction_type_id') }}</th>
                <th>{{ trans('accountHistory.backend.table.transaction_status_id') }}</th>
                <th>{{ trans('accountHistory.backend.table.transaction_status_id') }}</th>
                <th>{{ trans('accountHistory.backend.table.amount') }}</th>
                <th>{{ trans('accountHistory.backend.table.commission') }}</th>
                <th>{{ trans('accountHistory.backend.table.balance') }}</th>
                <th>{{ trans('accountHistory.backend.table.blocked_balance') }}</th>
                <th>{{ trans('accountHistory.backend.table.currency_id') }}</th>
                <th>{{ trans('accountHistory.backend.table.currency_rate_value') }}</th>
                <th>{{ trans('accountHistory.backend.table.user_id') }}</th>
                <th>{{ trans('accountHistory.backend.table.account_type_id') }}</th>
                <th>{{ trans('accountHistory.backend.table.session_number') }}</th>
                <th>{{ trans('accountHistory.backend.table.created_at') }}</th>

                {{--@if (isset($item->transaction_status->color))--}}
                    {{--"w2ui": { "style": "background-color: {{$item->transaction_status->color}}" },--}}
                {{--@endif--}}
                </thead>
                <tbody>
                @foreach($accountHistory as $item)
                    <tr
                        {@if (isset($item->transaction_status->color))
                            bgcolor = "{{$item->transaction_status->color}}",
                        @endif}>
                        <td>{{ $item->number }}</td>
                        <td>{{ $item->transaction_type->name}}</td>
                        <td>{{ $item->transaction_status->transaction_status_group->name }}</td>
                        <td>{{ $item->transaction_status->name }}</td>
                        <td>{{ $item->amount }}</td>
                        <td>{{ $item->commission }}</td>
                        <td>{{ $item->balance}}</td>
                        <td>{{ $item->blocked_balance}}</td>
                        <td>{{ $item->currency->name}}</td>
                        <td>{{ $item->currency_rate_value}}</td>
                        <td>{{ $item->user->msisdn}}</td>
                        <td>{{ $item->account_type->name}}</td>
                        <td>{{ $item->transaction->session_number}}</td>
                        <td>{{ $item->created_at}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div><!-- /.box-body -->
    <div class="box-footer">
        {{$accountHistory->render() }}
    </div>
</div><!-- /.box -->