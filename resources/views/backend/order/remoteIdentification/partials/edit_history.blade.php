<div class="box box-solid ">
    <div class="box-header with-border greenClass">
        <h3 class="box-title">История заявки</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                <th>{{ trans('orderHistory.backend.table.number') }}</th>
                <th>{{ trans('orderHistory.backend.table.from_user') }}</th>
                <th>{{ trans('orderHistory.backend.table.payload_params_json') }}</th>
                <th>{{ trans('orderHistory.backend.table.order_status') }}</th>
                <th>{{ trans('remoteIdentification.backend.table.process_status') }}</th>
                <th>Обработал</th>
                <th>{{ trans('orderHistory.backend.table.created_at') }}</th>
                <th>{{ trans('orderHistory.backend.table.updated_at') }}</th>

                {{--@if (isset($item->transaction_status->color))--}}
                    {{--"w2ui": { "style": "background-color: {{$item->transaction_status->color}}" },--}}
                {{--@endif--}}
                </thead>
                <tbody>
                @foreach($orderHistory as $item)
                    <tr>
                        <td>{{ $item->number ?? ''}}</td>
                        <td>{{ $item->from_user->msisdn ?? ''}}</td>
                        <td> <div class="{{ $item->payload_params_json==null ?: 'json-params' }}">{{ json_encode($item->payload_params_json, JSON_UNESCAPED_UNICODE) }}</div></td>
                        <td>{{ $item->order_status->name ?? ''}}</td>
                        <td>{{ $item->order_process_status->name ?? ''}}</td>
                        <td>{{ $item->updated_by_user->full_name_extended_format??''}}</td>
                        <td>{{ $item->created_at}}</td>
                        <td>{{ $item->updated_at}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div><!-- /.box-body -->
    <div class="box-footer">
        {{$orderHistory->render() }}
    </div>
</div><!-- /.box -->