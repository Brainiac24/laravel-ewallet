@foreach($remoteIdentifications as $item)
    {
    recid: '{{$item->id}}',
    created_at:'{{ $item->created_at}}',
    updated_at: '{{$item->updated_at}}',
    user_full_name:'{{ $item->remote_identification_payload_params["profile"]["Items"]["full_name"] ?? null}}',
    msisdn: '{{$item->from_user->msisdn??null}}',
    passport: '{{ $item->remote_identification_payload_params["profile"]["Items"]["passport_seria"] ?? null}}{{ $item->remote_identification_payload_params["profile"]["Items"]["passport_number"]?? null}}',
    address: '{{ $item->remote_identification_payload_params["profile"]["Items"]["address"] ?? null}}',
    inn: '{{ $item->remote_identification_payload_params["profile"]["Items"]["inn"] ?? null}}',
    status: '{{$item->order_status->name}}',
    process_status: '{{$item->order_process_status->name??null}}',
    user_attestation: '{{$item->from_user->attestation->name??null}}',
    processed_by_user: '{{$item->processed_by_user->full_name_extended_format??null}}',
    processed_by_user_id: '{{$item->processed_by_user_id}}',
    status_id: '{{$item->order_status->code}}',
    information: '{{$item->information}}',
    number: '{{$item->number??null}}',
    @if(isset($item->remote_identification_payload_params['history']['calls']) && $count=count($item->remote_identification_payload_params['history']['calls'])>0)
        call_status: '{{$orderCommentCalls[$item->remote_identification_payload_params['history']['calls'][$count-1]['order_comment_id']??'']??''}}',
    @else
        call_status: '',
    @endif
    comment: `{{str_replace("\r\n", '',$item->remote_identification_payload_params['history']['comment']??'')}}`,
    @if (isset($item->order_status->color))
        "w2ui": { "style": "background-color: {{$item->order_status->color}}" },
    @endif
    },
@endforeach