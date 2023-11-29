@foreach($dwhRules as $dwhRule)
    {
    recid: '{{$dwhRule->id}}',
    table: '{{$dwhRule->table}}',
    job_log_type: '{{ isset($dwhRule->job_log_type) ? $dwhRule->job_log_type . '=>'. config('job_log_type_helper.types')[$dwhRule->job_log_type] : ''}}',
    description: '{{$dwhRule->description }}',
    to_dwh_days: '{{$dwhRule->to_dwh_days}}',
    delete_from_dwh_days: '{{$dwhRule->delete_from_dwh_days}}',
    },
@endforeach