@foreach($jobLog as $item)
    {
    recid: '{{$item->id}}',
    transaction_id: '{{$item->transaction_id}}',
    order_id: '{{$item->order_id}}',
    {{--params_json: '<p class="{{ $item->params_json==null ?: 'json-params' }}">{{ json_encode($item->params_json, JSON_UNESCAPED_UNICODE) }}</p>',--}}
    params_json: '{{json_encode($item->params_json,JSON_UNESCAPED_UNICODE)}}',
    client_request_log: '{{json_encode($item->client_request_log,JSON_UNESCAPED_UNICODE)}}',
    is_error: '{{$item->is_error===1?'ДА':'НЕТ'}}',
    error_message: '{{$item->error_message}}',
    child_to_process_count: '{{$item->child_to_process_count}}',
    child_processed_count: '{{$item->child_processed_count}}',
    @if (array_key_exists($item->type, config('job_log_type_helper.types')))
        type:  '{{ config('job_log_type_helper.types')[$item->type] }}'
    @else
        type: '{{$item->type}}'
    @endif,
    is_completed: '{{$item->is_completed===1?'ДА':'НЕТ'}}',
    is_lock: '{{$item->is_lock===1?'ДА':'НЕТ'}}',
    allowed_try_count: '{{$item->allowed_try_count}}',
    created_by_user_id: '{{str_replace("\n", "", $item->createdBy->first_name)}}'+' '+'{{str_replace("\n", "", $item->createdBy->last_name)}}'+' '+'{{str_replace("\n", "", $item->createdBy->middle_name)}}',
    parent_id: '{{$item->parent_id}}',
    queue_request_log: '{{json_encode($item->queue_request_log,JSON_UNESCAPED_UNICODE)}}',
    queue_response_log: '{{json_encode($item->queue_response_log,JSON_UNESCAPED_UNICODE)}}',
    ip: '{{$item->ip}}',
    updated_at:'{{ $item->updated_at}}',
    created_at:'{{ $item->created_at}}',
    },
@endforeach