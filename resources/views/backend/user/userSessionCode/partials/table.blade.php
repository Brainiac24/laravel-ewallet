@foreach($userSessionCodes as $item)
    {
        recid: '{{$item->id}}',
        value: '{{$item->value}}',
        code: '{{$item->sms_code}}',
        unblock_at: '{{$item->unblock_at}}',
        blocked_at: '{{$item->blocked_at}}',
        code_sent_at: '{{$item->code_sent_at}}',
        user_session_code_type_id: '{{$item->user_session_code_type->name ?? ""}}',
        entity_type: '{{$item->entity_type}}',
        entity_id: '{{$item->entity_id}}',
        created_by_user_id: '{{$item->user->last_name ?? ""}}' + ' ' + '{{$item->user->first_name ?? ""}}' +' '+ '{{$item->user->middle_name ?? ""}}',
        updated_at:'{{ $item->updated_at}}',
        created_at:'{{ $item->created_at}}',
    },
@endforeach