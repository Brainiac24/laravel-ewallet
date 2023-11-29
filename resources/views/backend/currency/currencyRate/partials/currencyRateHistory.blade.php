<div class="box box-solid ">
    <div class="box-header with-border greenClass">
        <h3 class="box-title">История Катеровок данной Валюты</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                <th>{{ trans('currencyRate.backend.table.currency_id') }}</th>
                <th>{{ trans('currencyRate.backend.table.value_buy') }}</th>
                <th>{{ trans('currencyRate.backend.table.value_sell') }}</th>
                <th>{{ trans('accountHistory.backend.table.created_at') }}</th>
                </thead>
                <tbody>
                @foreach($currencyRateHistory as $item)
                    <tr>
                        <td>{{ $item->currency->name }}</td>
                        <td>{{ $item->value_buy }}</td>
                        <td>{{ $item->value_sell }}</td>
                        <td>{{ $item->created_at }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div><!-- /.box-body -->
</div><!-- /.box -->