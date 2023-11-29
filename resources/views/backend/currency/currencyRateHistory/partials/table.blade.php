<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
        <th style="width: 1px;">
            <input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);">
        </th>

        <th>{{ trans('currencyRate.backend.table.currency_id') }}</th>
        <th>{{ trans('currencyRate.backend.table.value_buy') }}</th>
        <th>{{ trans('currencyRate.backend.table.value_sell') }}</th>
        <th>{{ trans('currencyRate.backend.table.created_at') }}</th>
        <th>{{ trans('currencyRate.backend.table.updated_at') }}</th>
        </thead>
        <tbody>
            @foreach($currencyRateHistories as $item)
            <tr>
                <td><input type="checkbox" name="selected[]" value="{{ $item->id }}"></td>
                <td>{{  link_to(route('admin.currencies.rates.histories.show', [$item->id]), $item->currency->name ) }}</td>
                <td>{{ $item->value_buy }}</td>
                <td>{{ $item->value_sell }}</td>
                <td>{{ $item->created_at }}</td>
                <td>{{ $item->updated_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>