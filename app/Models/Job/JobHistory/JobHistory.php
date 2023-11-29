<?php

namespace App\Models\Job\JobHistory;

use App\Models\BaseModel;
use App\Models\User\User;
use App\Services\Common\Filter\Filterable;


class JobHistory extends BaseModel
{
    use Filterable;

    protected $fillable = [
        'id',
        'name',
        'payload',
        'created_by_user_id',
        'created_at',
        'updated_at',
        'processed_at',
        'finished_at',
        'filename',
        'error_message',
        'status',
        'created_by_user_id',
        'type',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }

}