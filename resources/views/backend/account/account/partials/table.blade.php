@foreach($accounts as $item)
    {   recid: '{{$item->id}}',
    number: '{{$item->number}}',
    balance: '{{$item->balance_hidden}}',
    blocked_balance: '{{$item->blocked_balance}}',
    first_name: '{{$item->user->first_name}}',
    last_name: '{{$item->user->last_name}}',
    middle_name: '{{$item->user->middle_name}}',
    account_status: '{{$item->account_status->name}}',
    account_type_id: '{{$item->account_type->name}}',
    user_id: '{{$item->user->msisdn}}',
    currency_id: '{{$item->currency->name}}',
    finished_at: '{{$item->finished_at}}',
    updated_at: '{{$item->updated_at}}',
    created_at: '{{$item->created_at}}',

    @if ($item->is_editable===false)
        "w2ui": { "style": "background-color: #C2F5B4" }
    @endif
    },
@endforeach



{{--


<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
        <th style="width: 1px;">
            <input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);">
        </th>
        <th>{{ trans('users.backend.table.msisdn') }}</th>
        <th>{{ trans('users.backend.table.username') }}</th>
        <th>{{ trans('users.backend.table.first_name') }}</th>
        <th>{{ trans('users.backend.table.middle_name') }}</th>
        <th>{{ trans('users.backend.table.last_name') }}</th>
        <th>{{ trans('users.backend.table.is_active') }}</th>
        <th>{{ trans('users.backend.table.is_auth') }}</th>
        <th>{{ trans('users.backend.table.is_admin') }}</th>
        <th>{{ trans('users.backend.table.blocked_at')}}</th>
        <th>{{ trans('users.backend.table.last_login_at')}}</th>
        <th>{{ trans('users.backend.table.gender')}}</th>
        <th>{{ trans('users.backend.table.is_editable')}}</th>
        <th>{{ trans('users.backend.table.created_at') }}</th>
        <th>{{ trans('users.backend.table.updated_at') }}</th>
        <th class="col-xs-1">{{ trans('actions.general.action') }}</th>
        </thead>
        <tbody>

        @foreach($users as $item)
            <tr>
                <td><input type="checkbox" name="selected[]" value="{{ $item->id }}"></td>
                <td>{{  link_to(route('admin.users.show', [$item->id]), $item->msisdn) }}</td>
                <td>{{ $item->username }}</td>
                <td>{{ $item->first_name }}</td>
                <td>{{ $item->middle_name }}</td>
                <td>{{ $item->last_name }}</td>
                <td>{{ $item->is_active===false ? 'Неактивен' : 'Активен' }}</td>
                <td>{{ $item->is_auth===false ? 'Неавторизован' : 'Авторизован'  }}</td>
                <td>{{ $item->is_admin===false ? 'НеАдмин' : 'Админ'  }}</td>
                <td>{{ $item->blocked_at }}</td>
                <td>{{ $item->last_login_at }}</td>
                <td>{{ trans('constantsInterface.gender.'.$item->gender)    }}</td>
                <td>{{ $item->is_editable }}</td>
                <td>{{ $item->created_at }}</td>
                <td>{{ $item->updated_at }}</td>

                <td class="text-center">
                    @if(Auth::user()->ability('sadmin','user-edit'))
                        <a class="btn btn-primary btn-xs" href="{!! route('admin.users.edit', [$item->id]) !!}"><i
                                    class="fa fa-pencil"></i></a>
                    @endif
                    @if(Auth::user()->ability('sadmin','user-delete'))
                        <a class="btn btn-danger btn-xs" href="{!! route('admin.users.delete', [$item->id]) !!}"
                           onclick="return confirm('{{ trans('alerts.general.confirm_delete') }}')"><i
                                    class="fa fa-trash-o"></i></a>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
--}}