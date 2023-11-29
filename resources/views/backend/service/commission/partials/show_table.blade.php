<div class="row">
    <div class="col-md-4">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                <th>{{ trans('commission.backend.table.min') }}</th>
                <th>{{ trans('commission.backend.table.max') }}</th>
                <th>{{ trans('commission.backend.table.value') }}</th>
                <th>{{ trans('commission.backend.table.is_persentage') }}</th>
                </thead>
                <tbody>
                @foreach($commission->params_json as $item)
                    <tr>
                        <td>{{ $item['min'] }}</td>
                        <td>{{ $item['max'] }}</td>
                        <td>{{ $item['value'] }}</td>
                        <td>{{ trans('InterfaceTranses.procentage.'.$item['is_percentage']) }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>