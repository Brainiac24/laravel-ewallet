<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
        <th style="width: 1px;">
            <input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);">
        </th>
        <th>{{ trans('userHistory.backend.table.event_id') }}</th>
        <th>{{ trans('userHistory.backend.table.old_params_json') }}</th>
        <th>{{ trans('userHistory.backend.table.new_params_json') }}</th>
        <th>{{ trans('userHistory.backend.table.entity_type') }}</th>
        <th>{{ trans('userHistory.backend.table.entity_id') }}</th>
        <th>{{ trans('userHistory.backend.table.description') }}</th>
        <th>{{ trans('userHistory.backend.table.user_id') }}</th>
        <th>{{ trans('userHistory.backend.table.event_id') }}</th>
        <th>{{ trans('userHistory.backend.table.created_at') }}</th>
        <th>{{ trans('userHistory.backend.table.updated_at') }}</th>
        <th class="col-xs-1">{{ trans('actions.general.action') }}</th>
        </thead>
        <tbody>

            @foreach($userServiceLimits as $item)
            <tr>
                <td><input type="checkbox" name="selected[]" value="{{ $item->id }}"></td>
                <td>{{  link_to(route('admin.users.show', [$item->id]), $item->event_id) }}</td>
                <td>{{ $item->old_params_json }}</td>
                <td>{{ $item->new_params_json }}</td>
                <td>{{ $item->entity_type }}</td>
                <td>{{ $item->entity_id }}</td>
                <td>{{ $item->description }}</td>
                <td>{{ $item->user_id }}</td>
                <td>{{ $item->event_id }}</td>
                <td>{{ $item->created_at }}</td>
                <td>{{ $item->updated_at }}</td>

                <td class="text-center">
                        {{-- @if(Auth::user()->ability('sadmin','role-operation-edit')) --}}

                            <a class="btn btn-primary btn-xs" href="{!! route('admin.users.edit', [$item->id]) !!}"><i class="fa fa-pencil"></i></a>
                        {{-- @endif --}}
                        {{-- @if(Auth::user()->ability('sadmin','role-operation-delete')) --}}
                            <a class="btn btn-danger btn-xs" href="{!! route('admin.users.delete', [$item->id]) !!}" onclick="return confirm('{{ trans('alerts.general.confirm_delete') }}')"><i class="fa fa-trash-o"></i></a>
                        {{-- @endif --}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>