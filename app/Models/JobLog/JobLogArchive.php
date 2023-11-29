<?php

namespace App\Models\JobLog;

use App\Models\BaseModel;
use App\Models\User\User;
use App\Services\Common\Filter\Filterable;


class JobLogArchive extends BaseModel
{
    use Filterable;

    protected $table="job_logs_archive";

    protected $casts = [
        'params_json' => 'array',
        'queue_response_log' => 'array',
    ];

    protected $fillable = [
        'id',
        'transaction_id',
        'order_id',
        'params_json',
        'client_request_log',
        'client_response',
        'is_error',
        'error_message',
        'child_to_process_count',
        'child_processed_count',
        'type',
        'is_completed',
        'is_lock',
        'allowed_try_count',
        'created_by_user_id',
        'parent_id',
        'queue_request_log',
        'queue_response_log',
        'ip',
        'created_at',
        'updated_at',
        'finished_at',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }
}
