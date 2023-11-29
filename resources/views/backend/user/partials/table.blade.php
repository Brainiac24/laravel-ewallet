@foreach($users as $item)
    {   recid: '{{$item->id}}',
    msisdn: '<a href="users/{{$item->id}}">{{$item->msisdn}}</a>',
    username: '{{$item->username}}',
    roles: '@foreach($item->roles as $role){{$role->display_name??null}};@endforeach',
    first_name: '{{ $item->first_name }}',
    middle_name: '{{ $item->middle_name }}',
    last_name: '{{ $item->last_name }}',
    is_active: '{{  trans('InterfaceTranses.is_active')[$item->is_active] }}',
    is_auth: '{{ $item->is_auth===false ? 'Неавторизован' : 'Авторизован'  }}',
    is_admin: '{{ $item->is_admin===false ? 'Клиент' : 'Пользователь'  }}',
    blocked_at: '{{ $item->blocked_at }}',
    last_login_at: '{{ $item->last_login_at }}',
    gender: '{{ trans('constantsInterface.gender.'.$item->gender)    }}',
    is_editable: '{{ $item->is_editable===false ? 'Запрещено' : 'Разрещено' }}',
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