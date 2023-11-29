<div class="box box-solid ">
    <div class="box-header with-border greenClass">
        <h3 class="box-title">История заявки</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                <th>{{ trans('orderHistory.backend.table.order_type') }}</th>
                <th>{{ trans('orderHistory.backend.table.number') }}</th>
                <th>{{ trans('orderHistory.backend.table.from_user') }}</th>
                <th>{{ trans('orderHistory.backend.table.to_user') }}</th>
                <th>{{ trans('orderHistory.backend.table.entity') }}</th>
                <th>{{ trans('orderHistory.backend.table.entity_id') }}</th>
                <th>{{ trans('orderHistory.backend.table.payload_params_json') }}</th>
                <th>{{ trans('orderHistory.backend.table.response') }}</th>
                <th>{{ trans('orderHistory.backend.table.order_status') }}</th>
                <th>{{ trans('orderHistory.backend.table.order_process_status') }}</th>
                <th>{{ trans('orderHistory.backend.table.is_queued') }}</th>
                <th>{{ trans('orderHistory.backend.table.created_at') }}</th>
                <th>{{ trans('orderHistory.backend.table.updated_at') }}</th>

                {{--@if (isset($item->transaction_status->color))--}}
                    {{--"w2ui": { "style": "background-color: {{$item->transaction_status->color}}" },--}}
                {{--@endif--}}
                </thead>
                <tbody>
                @foreach($orderHistory as $item)
                    <tr>
                        <td>{{ $item->order_type->name ?? '' }}</td>
                        <td>{{ $item->number ?? ''}}</td>
                        <td>{{ $item->from_user->msisdn ?? ''}}</td>
                        <td>{{ $item->to_user->msisdn ?? '' }}</td>
                        <td>{{ $item->entity_type }}</td>
                        <td>{{ $item->entity_id }}</td>
                        <td> <div class="{{ $item->payload_params_json==null ?: 'json-params' }}">{{ json_encode($item->payload_params_json, JSON_UNESCAPED_UNICODE) }}</div></td>
                        <td>{{ $item->response}}</td>
                        <td>{{ $item->order_status->name ?? ''}}</td>
                        <td>{{ $item->order_process_status->name ?? ''}}</td>
                        <td>{{ $item->is_queued}}</td>
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