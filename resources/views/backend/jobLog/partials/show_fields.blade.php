<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static">{{trans('jobLog.backend.table.id')}}:</p>
    </div>
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $jobLog->id }}</p>
    </div>
</div>

<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static">{{trans('jobLog.backend.table.transaction_id')}}:</p>
    </div>
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $jobLog->transaction_id }}</p>
    </div>
</div>

<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static">{{trans('jobLog.backend.table.order_id')}}:</p>
    </div>
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $jobLog->order_id }}</p>
    </div>
</div>

<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static">{{trans('jobLog.backend.table.params_json')}}:</p>
    </div>
    <div class='col-sm-9'>
        <p class="{{ $jobLog->params_json==null ?: 'json-params' }}">{{ json_encode($jobLog->params_json, JSON_UNESCAPED_UNICODE) }}</p>
    </div>
</div>

<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static">{{trans('jobLog.backend.table.client_request_log')}}:</p>
    </div>
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $jobLog->client_request_log }}</p>
    </div>
</div>

<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static">{{trans('jobLog.backend.table.client_response')}}:</p>
    </div>
    <div class='col-sm-9'>
        <p class="{{ $jobLog->client_response==null ?: 'json-params' }}">{{json_encode($jobLog->client_response, JSON_UNESCAPED_UNICODE) }}</p>
    </div>
</div>

<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static">{{trans('jobLog.backend.table.is_error')}}:</p>
    </div>
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $jobLog->is_error }}</p>
    </div>
</div>

<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static">{{trans('jobLog.backend.table.error_message')}}:</p>
    </div>
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $jobLog->error_message }}</p>
    </div>
</div>

<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static">{{trans('jobLog.backend.table.child_to_process_count')}}:</p>
    </div>
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $jobLog->child_to_process_count }}</p>
    </div>
</div>

<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static">{{trans('jobLog.backend.table.child_processed_count')}}:</p>
    </div>
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $jobLog->child_processed_count }}</p>
    </div>
</div>

<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static">{{trans('jobLog.backend.table.type')}}:</p>
    </div>
    <div class='col-sm-9'>
        <p class="form-control-static">
            @if (array_key_exists($jobLog->type, config('job_log_type_helper.types')))
                {{ config('job_log_type_helper.types')[$jobLog->type] }}
            @else
                {{$jobLog->type}}
            @endif
        </p>
    </div>
</div>

<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static">{{trans('jobLog.backend.table.is_completed')}}:</p>
    </div>
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $jobLog->is_completed }}</p>
    </div>
</div>

<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static">{{trans('jobLog.backend.table.child_to_process_count')}}:</p>
    </div>
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $jobLog->child_to_process_count }}</p>
    </div>
</div>

<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static">{{trans('jobLog.backend.table.is_lock')}}:</p>
    </div>
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $jobLog->is_lock }}</p>
    </div>
</div>

<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static">{{trans('jobLog.backend.table.allowed_try_count')}}:</p>
    </div>
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $jobLog->allowed_try_count }}</p>
    </div>
</div>

<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static">{{trans('jobLog.backend.table.created_by_user_id')}}:</p>
    </div>
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $jobLog->createdBy->first_name}} {{$jobLog->createdBy->last_name}} {{$jobLog->createdBy->middle_name}}</p>
    </div>
</div>

<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static">{{trans('jobLog.backend.table.parent_id')}}:</p>
    </div>
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $jobLog->parent_id }}</p>
    </div>
</div>

<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static">{{trans('jobLog.backend.table.is_lock')}}:</p>
    </div>
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $jobLog->is_lock }}</p>
    </div>
</div>

<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static">{{trans('jobLog.backend.table.queue_request_log')}}:</p>
    </div>
    <div class='col-sm-9'>
        <p class="{{ $jobLog->queue_request_log==null ? 'form-control-static' : 'json-params' }}">{{ $jobLog->queue_request_log }}</p>
    </div>
</div>

<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static">{{trans('jobLog.backend.table.queue_response_log')}}:</p>
    </div>
    <div class='col-sm-9'>
        <p class="{{ $jobLog->queue_response_log==null ? 'form-control-static' : 'json-params' }}">{{ json_encode($jobLog->queue_response_log) }}</p>
    </div>
</div>

<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static">{{trans('jobLog.backend.table.queue_response_log_text')}}:</p>
    </div>
    <div class='col-sm-9'>
        <p class="form-control-static">{{ isset($jobLog->queue_response_log['Body']) ? (base64_decode(json_decode(($jobLog->queue_response_log['Body']??null), true)['data']['response'])) : (isset($jobLog->queue_response_log['Data']['data']['response'])?$jobLog->queue_response_log['Data']['data']['response']:null)  }}</p>
    </div>
</div>

<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static">{{trans('jobLog.backend.table.ip')}}:</p>
    </div>
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $jobLog->ip }}</p>
    </div>
</div>

<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static">{{trans('jobLog.backend.table.created_at')}}:</p>
    </div>
    <div class='col-sm-9'>
        <p class="form-control-static">{{ \Carbon\Carbon::parse($jobLog->created_at)->format("d.m.Y H:i:s") }}</p>
    </div>
</div>

<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static">{{trans('jobLog.backend.table.updated_at')}}:</p>
    </div>
    <div class='col-sm-9'>
        <p class="form-control-static">{{ \Carbon\Carbon::parse($jobLog->updated_at)->format("d.m.Y H:i:s") }}</p>
    </div>
</div>

<div class="row r-hov-1">
    <div class='col-sm-2'>
        <p class="form-control-static">{{trans('jobLog.backend.table.finished_at')}}:</p>
    </div>
    <div class='col-sm-9'>
        <p class="form-control-static">{{ $jobLog->finished_at ? \Carbon\Carbon::parse($jobLog->finished_at)->format("d.m.Y H:i:s") : '' }}</p>
    </div>
</div>