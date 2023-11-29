@foreach($clients as $item)
    {   recid: '{{$item->id}}',
    {{--msisdn: '<a href="clients/{{$item->id}}/edit">{{$item->msisdn}}</a>',--}}
    msisdn: '{{$item->msisdn}}',
    first_name: '{{ $item->first_name }}',
    middle_name: '{{ $item->middle_name }}',
    last_name: '{{ $item->last_name }}',
    balance: '{{ $item->accounts[0]->balance??"НЕТ СЧЕТА" }} {{ $item->accounts[0]->currency->iso_name??"" }}',
    attestation: '{{ $item->attestation->name }}',
    email: '{{ $item->email }}',
    is_active: '{{ trans('InterfaceTranses.is_active.'.(int)$item->is_active)  }}',
    is_auth: '{{ $item->is_auth===false ? 'Неавторизован' : 'Авторизован'  }}',
    blocked_at: '{{ $item->blocked_at }}',
    last_login_at: '{{ $item->last_login_at }}',
    contacts_json: '{{ json_encode($item->contacts_json) }}',
    gender: '{{ trans('constantsInterface.gender.'.$item->gender)    }}',
    updated_at: '{{(string)$item->updated_at }}',
    created_at:'{{ $item->created_at}}',
@if ($item->is_active===false)
    "w2ui": { "style": "color: red" },
@endif
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
        <th>{{ trans("users.backend.table.msisdn") }}</th>
        <th>{{ trans("users.backend.table.username") }}</th>
        <th>{{ trans("users.backend.table.first_name") }}</th>
        <th>{{ trans("users.backend.table.middle_name") }}</th>
        <th>{{ trans("users.backend.table.last_name") }}</th>
        <th>{{ trans("users.backend.table.is_active") }}</th>
        <th>{{ trans("users.backend.table.is_auth") }}</th>
        <th>{{ trans("users.backend.table.is_admin") }}</th>
        <th>{{ trans("users.backend.table.blocked_at")}}</th>
        <th>{{ trans("users.backend.table.last_login_at")}}</th>
        <th>{{ trans("users.backend.table.gender")}}</th>
        <th>{{ trans("users.backend.table.is_editable")}}</th>
        <th>{{ trans("users.backend.table.created_at") }}</th>
        <th>{{ trans("users.backend.table.updated_at") }}</th>
        <th class="col-xs-1">{{ trans('actions.general.action') }}</th>
        </thead>
        <tbody>
        @foreach($clients as $item)
            <tr>
                <td><input type="checkbox" name="selected[]" value="{{ $item->id }}"></td>
                <td>{{  link_to(route('admin.clients.show', [$item->id]), $item->msisdn) }}</td>
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
                        <a class="btn btn-primary btn-xs" href="{!! route('admin.clients.edit', [$item->id]) !!}"><i
                                    class="fa fa-pencil"></i></a>
                    @endif
                    @if(Auth::user()->ability('sadmin','user-delete'))
                        <a class="btn btn-danger btn-xs" href="{!! route('admin.clients.delete', [$item->id]) !!}"
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
