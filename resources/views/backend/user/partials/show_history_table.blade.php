<div class="box box-solid">
    <div class="box-header with-border greenClass">
        <h3 class="box-title">История действий пользователя</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
    <div class="table-responsive">
    <table class="table table-bordered table-hover">
        
        <thead>
            <th>{{ trans('userHistory.backend.table.ip') }}</th>
            <th>{{ trans('userHistory.backend.table.old_params_json') }}</th>
            <th>{{ trans('userHistory.backend.table.new_params_json') }}</th>
            <th>{{ trans('userHistory.backend.table.event_id') }}</th>
            <th>{{ trans('userHistory.backend.table.created_at') }}</th>
            <th>{{ trans('userHistory.backend.table.entity_type') }}</th>
            <th>{{ trans('userHistory.backend.table.entity_id') }}</th>
    
            </thead>
            <tbody>
            @foreach($userHistories as $item)
                <tr>
                    <td>{{ $item->ip }}</td>
                    <td><div class="{{ $item->old_params_json==null ?: 'json-params' }}">{{ json_encode($item->old_params_json, JSON_UNESCAPED_UNICODE) }}</div></td>
                    <td><div class="{{ $item->new_params_json==null ?: 'json-params' }}">{{ json_encode($item->new_params_json, JSON_UNESCAPED_UNICODE) }}</div></td>
                    <td>{{ $item->user_events->name??null }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>{{ $item->entity_type }}</td>
                    <td>{{ $item->entity_id }}</td>
    
                </tr>
            @endforeach
            </tbody>
    </table>
</div>
        <div class="box-footer">
            {{$userHistories->render() }}
        </div>
    </div><!-- /.box-body -->

</div>
