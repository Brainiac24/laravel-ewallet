<div class="box box-solid ">
    @if($userHistory!=null)
    <div class="box-header with-border greenClass">
        <h3 class="box-title ">История действий</h3>
    </div><!-- /.box-header -->
    <table class="table table-bordered table-hover">
        <thead>
        <th>{{ trans('userHistory.backend.table.ip') }}</th>
        <th>{{ trans('userHistory.backend.table.old_params_json') }}</th>
        <th>{{ trans('userHistory.backend.table.new_params_json') }}</th>
        <th>{{ trans('userHistory.backend.table.event_id') }}</th>
        <th>{{ trans('userHistory.backend.table.created_at') }}</th>

        </thead>
        <tbody>
        @foreach($userHistory as $item)
            <tr>
                <td>{{ $item->ip }}</td>
                <td><div class="{{ $item->old_params_json==null ?: 'json-params' }}">{{ json_encode($item->old_params_json, JSON_UNESCAPED_UNICODE) }}</div></td>
                <td><div class="{{ $item->new_params_json==null ?: 'json-params' }}">{{ json_encode($item->new_params_json, JSON_UNESCAPED_UNICODE) }}</div></td>
                <td>{{ $item->user_events->name??null }}</td>
                <td>{{ $item->created_at }}</td>

            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="box-footer">
        {{$userHistory->render() }}
    </div><!-- box-footer -->
    @endif
</div>