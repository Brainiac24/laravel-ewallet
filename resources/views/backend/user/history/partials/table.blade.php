<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
        <th style="width: 1px;">
            <input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);">
        </th>
        <th>{{ trans('userHistory.backend.table.event_id') }}</th>
        <th>{{ trans('userHistory.backend.table.entity_type') }}</th>
        <th>{{ trans('userHistory.backend.table.description') }}</th>
        <th>{{ trans('userHistory.backend.table.user_id') }}</th>
        <th>{{ trans('userHistory.backend.table.event_id') }}</th>
        <th>{{ trans('userHistory.backend.table.created_at') }}</th>
        <th>{{ trans('userHistory.backend.table.updated_at') }}</th>
        </thead>
        <tbody>
            @foreach($userHistories as $item)
            <tr>
                <td><input type="checkbox" name="selected[]" value="{{ $item->id }}"></td>
                <td>{{  link_to(route('admin.users.histories.show', [$item->id]), $item->event_id) }}</td>
                <td>{{ $item->entity_type }}</td>
                <td>{{ $item->description }}</td>
                <td>{{ $item->users->msisdn }}</td>
                <td>{{ $item->user_events->name }}</td>
                <td>{{ $item->created_at }}</td>
                <td>{{ $item->updated_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>