@foreach($unverifiedUsers as $item)
    {
        recid: '{{$item->id}}',
        msisdn: '{{$item->msisdn}}',
        blocked_count: '{{$item->blocked_count}}',
        blocked_at: '{{$item->blocked_at}}',
        unblock_at: '{{$item->unblock_at}}',
        ip: '{{$item->user_agent}}',
        devices_json: '{{json_encode($item->devices_json,JSON_UNESCAPED_UNICODE)}}',
        @if($item->sms_params_json===null)
            sms_params_json: 'null',
        @else
            sms_params_json:'{{$item->sms_params_json['code_sent_at']??""}}',
        @endif
        updated_at:'{{ $item->updated_at}}',
        created_at:'{{ $item->created_at}}',
    },
@endforeach